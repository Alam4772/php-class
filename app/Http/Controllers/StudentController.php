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

    public function create()
    {
        return view('student-create');
    }

    public function insert(Request $request)
    {
        Student::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'mobile_number' => $request->get('mobile_number'),
        ]);

        return redirect('student/list');
    }

    public function edit($id)
    {
        $student = Student::find($id);

        return view('student-edit', ['student' => $student]);
    }

    public function update($id, Request $request)
    {
        Student::where('id', $id)->update(
            [
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email'),
                'mobile_number' => $request->get('mobile_number'),
            ]
        );

        return redirect('student/list');
    }

    public function delete($id)
    {
        Student::where('id', $id)->delete();

        return response(['message' => 'Record deleted successfully.']);
    }
}
