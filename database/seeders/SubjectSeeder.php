<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        Subject::insert([
            [
                'subject_name' => 'Mathematics',
                'subject_description' => 'Basic Mathematics',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'subject_name' => 'Science',
                'subject_description' => 'General Science',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'subject_name' => 'English',
                'subject_description' => 'Basic English Language',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
