<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSubject extends Model
{
    protected $table = 'student_subject';

    protected $fillable = [
        'year_level',
        'grade',
        'student_id',
        'subject_id',
        'professor_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function professor()
    {
        return $this->belongsTo(Professor::class, 'professor_id');
    }
}
