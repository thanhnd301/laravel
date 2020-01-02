<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();

        return view('student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $formData = [
            'title' => 'Add Student',
            'url' => route('students.store')
        ];
        return view('student.form', compact('formData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name'=>'required','email'=>'required']);
        if($request->get('student_id')) {
            $student = Student::find($request->get('student_id'));
            $student->name = $request->get('name');
            $student->dob = $request->get('dob');
            $student->general =$request->get('general');
            $student->email = $request->get('email');
        } else {
            $student = new Student([
                'name' => $request->get('name'),
                'dob'=> $request->get('dob'),
                'general'=> $request->get('general'),
                'email' => $request->get('email')
            ]);
        }

        $student->save();
        return redirect('/students')->with('success', 'Student has been added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        $formData = [
            'student' => $student,
            'title' => 'Update Student',
            'url' => route('students.store')
        ];
        return view('student.form', compact('formData'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        if($student) {
            $student->delete();
        }

        return redirect('/students')->with('success', 'Student has been dropped');
    }
}
