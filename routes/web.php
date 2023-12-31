<?php

use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\StudentController;
use App\Models\Student;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/grades', [
        StudentController::class, 'index'
    ])->name('grades');

    Route::post('/save-grade', [
        StudentController::class, 'saveGrade'
    ])->name('grades.save');

    Route::get('/upload-grades', [
        ProfessorController::class, 'uploadGrades'
    ])->name('upload-grades');

    Route::get('/students', [
        ProfessorController::class, 'index'
    ])->name('student');

    Route::post('/{subjectId}/approve-grade', [
        ProfessorController::class, 'approve'
    ])->name('grade.approve');
});

