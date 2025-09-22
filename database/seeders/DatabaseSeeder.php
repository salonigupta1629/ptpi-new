<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // First run the initial seeders with all base data
        $this->call([
            DatabaseInitialSeeder::class,
        ]);

        // Create test user
        User::factory()->create([
            'role' => 'admin',
            'name' => 'Test User',
            'email' => 'test1@example.com',
            'password' => bcrypt('password'),
        ]);


 // Run recruiter seeder
    $this->call([
        RecruiterSeeder::class,
    ]);

        // Then run the teacher seeder
        $this->call([
            TeacherSeeder::class,
        ]);
    }
}
