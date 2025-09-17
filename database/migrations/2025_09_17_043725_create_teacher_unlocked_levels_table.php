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
        Schema::create('teacher_unlocked_levels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
        $table->foreignId('level_id')->constrained()->onDelete('cascade');
        $table->decimal('score', 5, 2)->default(0);
        $table->boolean('passed')->default(false);
        $table->timestamps();
        
        $table->unique(['teacher_id', 'level_id']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_unlocked_levels');
    }
};
