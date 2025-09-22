<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class RecruiterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $recruiters = [
            [
                'role' => 'recruiter',
                'name' => 'John Doe - Recruiter',
                'email' => 'john.recruiter@example.com',
                'password' => bcrypt('password123'),
                'email_verified_at' => now(),
                'is_verified' => 1,
            ],
            [
                'role' => 'recruiter',
                'name' => 'Jane Smith - Recruiter',
                'email' => 'jane.recruiter@example.com',
                'password' => bcrypt('password123'),
                'email_verified_at' => now(),
                'is_verified' => 1,
            ]
        ];

        foreach ($recruiters as $recruiter) {
            User::create($recruiter);
        }

        // Or use factory to create multiple random recruiters
        User::factory()->count(5)->create([
            'role' => 'recruiter',
        ]);
    }
}