<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\StudentGame;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function listView()
    {
        try {

            return view('student-list');
        } catch (\Exception $e) {

            echo $e->getMessage();
        }
    }

    public function list(Request $request)
    {
        if ($request->get('searchText') == null || $request->get('searchText') == '') {

            $students = Student::with('user')->orderBy('id', 'DESC')->get();
        } else {

            $search = $request->get('searchText');

            $students = Student::with('user')->where('first_name', 'like', "%$search%")
                ->orWhere('last_name', 'like', "%$search%")
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
        $data = [
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'mobile_number' => $request->get('mobile_number'),
        ];


        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $extension = $image->getClientOriginalExtension();

            // $name = $image->getClientOriginalName();

            $name = time() . '.' . $extension;

            //Upload Image to folder
            $image->move(public_path('assets/images'), $name);

            $data['image'] = $name;
        }

        Student::create($data);

        return redirect('student/list');
    }

    public function edit($id)
    {
        $student = Student::find($id);

        return view('student-edit', ['student' => $student]);
    }

    public function update($id, Request $request)
    {
        $student = Student::where('id', $id)->first();

        $data = [
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'mobile_number' => $request->get('mobile_number'),
        ];

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $extension = $image->getClientOriginalExtension();

            // $name = $image->getClientOriginalName();

            $name = time() . '.' . $extension;

            //Upload Image to folder
            $image->move(public_path('assets/images'), $name);

            $data['image'] = $name;

            if ($student->image !== null) {

                unlink(public_path("assets/images/$student->image"));
            }
        }

        $student->update($data);

        return redirect('student/list');
    }

    public function delete($id)
    {
        try {

            $student = Student::where('id', $id)->first();

            if ($student->image !== null) {

                unlink(public_path("assets/images/$student->image"));
            }

            $student->delete();

            return response(['message' => 'Record deleted successfully.']);

        } catch (\Exception $e) {

            return response(['message' => $e->getMessage()], 400);
        }
    }
}
