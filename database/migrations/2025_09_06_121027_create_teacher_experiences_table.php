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
        Schema::create('teacher_experiences', function (Blueprint $table) {
           $table->id(); // id INT PK, Auto Increment
           $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade'); // FK -> Role(id)

            $table->string('institution', 255)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('description')->nullable();
            $table->text('achievements')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_experiences');
    }
};
