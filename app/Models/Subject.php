<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'name',
        'prerequisite_subject_id',
        'course_description',
        'course_code'
    ];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'student_id');
    }

    public function preRequisite(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'prerequisite_subject_id', 'id');
    }
}
