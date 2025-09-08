<?php

namespace Database\Seeders;

use App\Models\TeacherJobType;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TeacherJobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        TeacherJobType::insert([
            ['teacher_job_name' => 'Full-time', 'description' => 'Full-time employment', 'created_at' => $now, 'updated_at' => $now],
            ['teacher_job_name' => 'Part-time', 'description' => 'Part-time employment', 'created_at' => $now, 'updated_at' => $now],
            ['teacher_job_name' => 'Contract', 'description' => 'Contract-based employment', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
