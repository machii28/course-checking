<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->change();
            $table->unsignedBigInteger('course_id')->change();
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('grades', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id')->change();
            $table->unsignedBigInteger('course_id')->change();
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('course_id')->references('id')->on('courses');
        });

        Schema::table('student_subject', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id')->change();
            $table->unsignedBigInteger('subject_id')->change();
            $table->unsignedBigInteger('professor_id')->change();
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('professor_id')->references('id')->on('professors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
