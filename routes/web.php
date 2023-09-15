<?php

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

Route::post('/add-subject', function () {
    $student = Student::where('id', request()->input('student_id'))->first();
    $pivotData = [
        'year_level' => $student->year_level
    ];
    $student->subjects()->attach(request()->input('subject_id'), $pivotData);

    return response()->json([
        'message' => 'success'
    ]);
});

Route::post('/remove-subject', function () {
    $student = Student::where('id', request()->input('student_id'))->first();

    $student->subjects()->detach(request()->input('subject_id'));

    return response()->json([
        'message' => 'success'
    ]);
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
});

