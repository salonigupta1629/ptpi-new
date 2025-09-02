<?php

namespace Database\Seeders;

use App\Models\TeacherJobType;
use App\Models\Skill;
use App\Models\ClassCategory;
use App\Models\EducationalQualification;
use App\Models\Level;
use App\Models\Subject;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test1@example.com',
        ]);


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

        ClassCategory::insert([
            ['name' => '0 to 5', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '6 to 10', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '11 to 12', 'created_at' => $now, 'updated_at' => $now],
        ]);

        EducationalQualification::insert([
            ['name' => 'BCA', 'description' => 'Bachelor of Computer Applications', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'MCA', 'description' => 'Master of Computer Applications', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'B.Sc', 'description' => 'Bachelor of Science', 'created_at' => $now, 'updated_at' => $now],
        ]);

        Skill::insert([
            ['name' => 'PHP', 'description' => 'Hypertext Preprocessor', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Laravel', 'description' => 'Laravel Framework', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'JavaScript', 'description' => 'Frontend + Backend scripting', 'created_at' => $now, 'updated_at' => $now],
        ]);

        Level::insert([
            ['name' => 'Level 1', 'description' => 'For beginners', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Level 2', 'description' => 'Intermediate level', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Level 3', 'description' => 'Advanced level', 'created_at' => $now, 'updated_at' => $now],
        ]);

        TeacherJobType::insert([
            ['teacher_job_name' => 'Full-time', 'description' => 'Full-time employment', 'created_at' => $now, 'updated_at' => $now],
            ['teacher_job_name' => 'Part-time', 'description' => 'Part-time employment', 'created_at' => $now, 'updated_at' => $now],
            ['teacher_job_name' => 'Contract', 'description' => 'Contract-based employment', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
