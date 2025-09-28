<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('interview_schedules', function (Blueprint $table) {
            $table->id();
         $table->foreignId('exam_attempt_id')->constrained()->onDelete('cascade');
    $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
    $table->dateTime('scheduled_at');
    $table->dateTime('requested_at');
    $table->enum('status', ['pending', 'approved', 'rejected', 'scheduled', 'completed'])
          ->default('pending');
    $table->string('meeting_link')->nullable();
    $table->text('teacher_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interview_schedules');
    }
};
