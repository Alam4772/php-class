<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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
}
