<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeDetailSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('employee_details')->insert([
                'employee_id' => $i,
                'job_desk_id' => rand(1, 3),
                'employment_type' => ['full_time', 'part_time'][rand(0, 1)],
                'salary' => rand(3000000, 7000000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
