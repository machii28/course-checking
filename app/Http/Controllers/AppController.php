<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function addSubject(Request $request)
    {
        $student = Student::where('id', $request->input('student'))->first();

        $student->subjects()->attach($request->input('subject_id'));

        return response()->json([
            'message' => 'success'
        ]);
    }

    public function removeSubject(Request $request)
    {
        $student = Student::where('id', $request->input('student_id'))->first();

        $student->subjects()->detach($request->input('subject_id'));

        return response()->json([
            'message' => 'success'
        ]);
    }
}
