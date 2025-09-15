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
        Schema::create('teacher_qualifications', function (Blueprint $table) {
            $table->id(); // id INT PK, Auto Increment
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('qualification_id')->constrained('educational_qualifications')->onDelete('cascade');; // FK -> EducationalQualification(id)
            $table->string('institution', 225)->nullable();
            $table->string('board_or_university');
            $table->string('session');
            $table->integer('year_of_passing')->nullable();
            $table->string('grade_or_percentage', 50)->nullable();
            $table->json('subjects');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_qualifications');
    }
};
