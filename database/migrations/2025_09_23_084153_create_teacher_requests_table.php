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
        Schema::create('teacher_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recruiter_id')->constrained('users')->onDelete('cascade'); // Links to users
            $table->foreignId('class_id')->constrained('class_categories')->onDelete('cascade'); // Fix: Links to class_categories
            $table->json('subject_ids');
            $table->string('pincode', 6)->index(); // Index for faster lookups
            $table->string('state', 100);
            $table->string('city', 100);
            $table->string('area', 100);
            $table->text('reject_reason')->nullable();
            $table->text('admin_notes')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_requests');
    }
};
