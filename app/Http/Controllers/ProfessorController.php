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

    public function uploadGrades(Request $request)
    {
        $data = [];
        $data['students'] = null;
        $auth = auth()->user();

        if ($request->has('student_id')) {
            $data['students'] = StudentSubject::with(['student', 'subject'])->select([
                    'student_subject.id',
                    'student_subject.student_id',
                    'student_subject.subject_id',
                    'student_subject.grade',
                    'student_subject.professor_id'
                ])->join('students', 'students.id', '=', 'student_subject.student_id')
                ->where('students.student_number', $request->get('student_id'))
                ->where('student_subject.professor_id', $auth->professor->id)
                ->get();

        }

        if ($request->has('subject') && $request->get('subject') !== null) {
            $data['students'] = StudentSubject::with(['student', 'subject'])->select([
                    'student_subject.id',
                    'student_subject.student_id',
                    'student_subject.subject_id',
                    'student_subject.grade',
                    'student_subject.professor_id'
                ])->join('subjects', 'subjects.id', '=', 'student_subject.subject_id')
                ->where('subjects.name', $request->get('subject'))
                ->where('student_subject.professor_id', $auth->professor->id)
                ->get();
        }

        return view('professor.upload-grades', $data);
    }


    public function approve($subjectId)
    {
        $subject = StudentSubject::find($subjectId);
        $subject->is_approved = true;

        $subject->save();

        return redirect()->back();
    }
}
