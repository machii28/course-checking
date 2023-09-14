<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use CrudTrait;
    use HasFactory;

    const STUDENT_YEAR_LEVEL = [
        '1st Year',
        '2nd Year',
        '3rd Year',
        '4th Year',
    ];

    protected $fillable = [
        'student_number',
        'user_id',
        'course_id',
        'year_level'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }

    public function course(): BelongsTo
    {
        return  $this->belongsTo(Course::class);
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class);
    }
}
