<?php

namespace App\Http\Controllers;

use App\Models\Grade;
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
}
