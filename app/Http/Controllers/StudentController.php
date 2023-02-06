<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function listView()
    {
        return view('student-list');
    }

    public function list(Request $request)
    {
        if($request->get('searchText') == null || $request->get('searchText') == '') {

            $students = Student::orderBy('id', 'DESC')->get();
        }else {

            $search = $request->get('searchText');

            $students = Student::where('first_name', 'like', "%$search%")
                                ->orWhere('last_name', 'like', "%$search%")
                                ->orWhere('email', 'like', "%$search%")
                                ->orWhere('mobile_number', 'like', "%$search%")
                                ->orderBy('id', 'DESC')
                                ->get();
        }

        return response($students);
    }
}
