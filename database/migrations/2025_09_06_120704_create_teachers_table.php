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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id(); // id INT PK, Auto Increment
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('gender', ['Female', 'Male', 'other'])->nullable();
            $table->string('religion', 100)->nullable();
            $table->enum('nationality', ['Indian', 'other'])->nullable();
            $table->string('image', 255)->nullable();
            $table->string('aadhar_no', 12)->unique()->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('alternate_phone', 15)->nullable();
            $table->boolean('verified')->default(false);
            $table->decimal('rating', 3, 2)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('availability_status', 50)->default('Available');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
