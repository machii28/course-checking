<?php

namespace App\Http\Controllers;

use App\Models\StudentSubject;
use App\Models\User;
use Illuminate\Http\Request;
class StudentController extends Controller
{
    public function index()
    {
        $data = [];
        $user = User::find(auth()->id());
        $data['subjects'] = $user->student->subjects;

        return view('student.grade', $data);
    }

    public function saveGrade($gradeId, Request $request)
    {
        $grade = StudentSubject::where('id', $gradeId)->first();

        $grade->grade = $request->get('grade');
        $grade->save();

        return redirect(route('grades'));
    }
}
