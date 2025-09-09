<?php

namespace Database\Seeders;

use App\Models\ClassCategory;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ClassCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        ClassCategory::insert([
            ['name' => '0 to 5', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '6 to 10', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '11 to 12', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
