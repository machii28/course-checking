<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'curricula';
    protected $guarded = ['id'];

    protected $fillable = [
        'academic_year',
        'course_code',
        'semester'
    ];
}
