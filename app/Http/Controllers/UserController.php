<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;
use Validator;
use Mail;

class UserController extends Controller
{
    public function displayLogin()
    {
        return view('login');
    }

    public function doLogin(Request $request)
    {
        $isValid = Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ]);

        if($isValid == true) {

            return redirect('student/list');
        }else {

            return back()->withErrors(['message' => 'Credentials does not match.']);
        }
    }

    public function doLogout()
    {
        Auth::logout();

        return redirect('user/login');
    }

    public function registerView()
    {
        return view('user-register');
    }

    public function register(Request $request)
    {
        $student = $request->get('student');
        $user = $request->get('user');

        $studentValidator = Validator::make($student, [
            "first_name" => "required",
            "last_name" => "required",
            "mobile_number" => "required",
        ]);

        $userValidator = Validator::make($user, [
            "email" => "required|unique:users,email",
        ]);


        if(!$studentValidator->fails()) {

            if(!$userValidator->fails()) {

                $user['name'] = $student['first_name'] . ' ' . $student['last_name'];


                $user = User::create($user);

                $student['user_id'] = $user->id;

                $student = Student::create($student);

                $token = base64_encode($user->email);

                $data['user'] = $user;
                $data['link'] = url("email/verification/$token");

                Mail::send('emails.register', $data, function($message) use($user) {
                    $message->to($user->email, $user->name)->subject
                       ('Email Verification');
                    $message->from(env('MAIL_FROM_ADDRESS'));
                 });
            }
        }
    }

    public function emailVerification($token)
    {
        $email =  base64_decode($token);

        User::whereEmail($email)->update([
            'email_verified_at' => Carbon::now()
        ]);

        return redirect("show/password/generate/$token");
    }

    public function showPasswordGenerate($token)
    {
        return view('generate-password', array('token' => $token));
    }

    public function savePassword($token, Request $request)
    {
        $email =  base64_decode($token);

        $user = $request->get('user');

        User::whereEmail($email)->update([
            'password' => bcrypt($user['password'])
        ]);

        return redirect("user/login");
    }
}
