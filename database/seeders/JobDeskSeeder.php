<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobDeskSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('job_desks')->insert([
            ['job_name' => 'Washer', 'created_at' => now(), 'updated_at' => now()],
            ['job_name' => 'Ironer', 'created_at' => now(), 'updated_at' => now()],
            ['job_name' => 'Cashier', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
