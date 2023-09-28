<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentSubject;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['student'] = null;

        if ($request->has('student_id')) {
            $data['student'] = Student::with(['user', 'subjects'])
                ->where('student_number', $request->get('student_id'))
                ->first();
        }

        return view('professor.student', $data);
    }


    public function approve($subjectId)
    {
        $subject = StudentSubject::find($subjectId);
        $subject->is_approved = true;

        $subject->save();

        return redirect()->back();
    }
}
