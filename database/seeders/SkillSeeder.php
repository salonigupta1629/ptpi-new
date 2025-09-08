<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        Skill::insert([
            ['name' => 'PHP', 'description' => 'Hypertext Preprocessor', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Laravel', 'description' => 'Laravel Framework', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'JavaScript', 'description' => 'Frontend + Backend scripting', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
