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
        Schema::create('teachers_addresses', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('address_type', ['current', 'permanent'])->nullable();
            $table->string('state', 100)->default('Bihar');
            $table->string('division', 100)->nullable();
            $table->string('district', 100)->nullable();
            $table->string('block', 100)->nullable();
            $table->string('village', 100)->nullable();
            $table->text('area')->nullable();
            $table->string('pincode', 6)->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers_addresses');
    }
};
