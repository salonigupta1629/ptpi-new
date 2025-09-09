<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        Role::insert([
            ['name' => 'Teacher', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Senior Teacher', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Head Teacher', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Principal', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
