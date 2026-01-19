<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('customers')->insert([
            ['customer_name' => 'John Doe', 'phone_number' => '081234567890', 'created_at' => now(), 'updated_at' => now()],
            ['customer_name' => 'Jane Smith', 'phone_number' => '089876543210', 'created_at' => now(), 'updated_at' => now()],
            ['customer_name' => 'Michael Lee', 'phone_number' => '081122334455', 'created_at' => now(), 'updated_at' => now()],
            ['customer_name' => 'Sarah Kim', 'phone_number' => '082233445566', 'created_at' => now(), 'updated_at' => now()],
            ['customer_name' => 'David Brown', 'phone_number' => '083344556677', 'created_at' => now(), 'updated_at' => now()],
            ['customer_name' => 'Emily White', 'phone_number' => '084455667788', 'created_at' => now(), 'updated_at' => now()],
            ['customer_name' => 'Daniel Green', 'phone_number' => '085566778899', 'created_at' => now(), 'updated_at' => now()],
            ['customer_name' => 'Sophia Black', 'phone_number' => '086677889900', 'created_at' => now(), 'updated_at' => now()],
            ['customer_name' => 'Chris Evans', 'phone_number' => '087788990011', 'created_at' => now(), 'updated_at' => now()],
            ['customer_name' => 'Olivia Martin', 'phone_number' => '088899001122', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
