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
        Schema::create('exam_attempts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('exam_set_id')->constrained()->onDelete('cascade');
        $table->enum('status', ['in_progress', 'completed', 'exited'])->default('in_progress');
        $table->string('language', 50)->default('english');
        $table->decimal('score', 6, 2)->nullable();
        $table->timestamp('started_at')->useCurrent();
        $table->timestamp('ended_at')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_attempts');
    }
};
