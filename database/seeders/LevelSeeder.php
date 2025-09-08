<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        Level::insert([
            ['name' => 'Level 1', 'description' => 'For beginners', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Level 2', 'description' => 'Intermediate level', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Level 3', 'description' => 'Advanced level', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
