<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseInitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            ClassCategorySeeder::class,
            SubjectSeeder::class,
            EducationalQualificationSeeder::class,
            SkillSeeder::class,
            LevelSeeder::class,
            TeacherJobTypeSeeder::class,
            RoleSeeder::class,
        ]);
    }
}
