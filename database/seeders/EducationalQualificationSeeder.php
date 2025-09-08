<?php

namespace Database\Seeders;

use App\Models\EducationalQualification;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EducationalQualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        EducationalQualification::insert([
            ['name' => 'BCA', 'description' => 'Bachelor of Computer Applications', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'MCA', 'description' => 'Master of Computer Applications', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'B.Sc', 'description' => 'Bachelor of Science', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
