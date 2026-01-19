<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Andi Pratama', 'Budi Santoso', 'Citra Lestari', 'Dewi Anggraini',
            'Eko Saputra', 'Fajar Nugroho', 'Gita Maharani', 'Hadi Wijaya',
            'Intan Permata', 'Joko Susilo'
        ];

        foreach ($names as $name) {
            DB::table('employees')->insert([
                'employee_name' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
