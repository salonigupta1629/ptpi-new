<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up(): void
    {
        Schema::table('levels', function (Blueprint $table) {
            $table->integer('order')->default(0)->after('description');
        });
        
        // Set initial order values for existing levels
        $this->setInitialLevelOrders();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('levels', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
    
    /**
     * Set initial order values for existing levels
     */
    private function setInitialLevelOrders(): void
    {
        // This will run after the column is added
      DB::table('levels')->update([
            'order' => DB::raw('id')
        ]);
    }
};