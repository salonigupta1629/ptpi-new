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
        Schema::table('user_answers', function (Blueprint $table) {
                 $table->decimal('score', 5, 2)->nullable()->after('selected_answer');
        $table->string('status')->default('completed')->after('score'); // completed, time_up, exited
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_answers', function (Blueprint $table) {
              $table->dropColumn(['score', 'status']);
        });
    }
};
