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
        Schema::table('subjects', function (Blueprint $table) {
            $table->string('course_code')->after('name')->nullable();
            $table->longText('course_description')->after('name')->nullable();
            $table->unsignedBigInteger('prerequisite_subject_id')->after('name')->nullable();

            $table->foreign('prerequisite_subject_id')->references('id')
                ->on('subjects')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropForeign(['prerequisite_subject_id']);

            $table->dropColumn('course_code');
            $table->dropColumn('course_description');
            $table->dropColumn('prerequisite_subject_id');
        });
    }
};
