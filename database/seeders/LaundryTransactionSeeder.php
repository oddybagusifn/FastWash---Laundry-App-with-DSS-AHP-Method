<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaundryTransactionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('laundry_transactions')->insert([
            [
                'customer_id' => 1,
                'transaction_date' => now(),
                'laundry_weight' => 5.5,
                'hpp_per_kg' => 7000,
                'total_hpp' => 38500,
                'total_price' => 55000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 2,
                'transaction_date' => now(),
                'laundry_weight' => 3.2,
                'hpp_per_kg' => 7000,
                'total_hpp' => 22400,
                'total_price' => 32000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 3,
                'transaction_date' => now(),
                'laundry_weight' => 7.1,
                'hpp_per_kg' => 7000,
                'total_hpp' => 49700,
                'total_price' => 71000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 4,
                'transaction_date' => now(),
                'laundry_weight' => 2.5,
                'hpp_per_kg' => 7000,
                'total_hpp' => 17500,
                'total_price' => 25000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 5,
                'transaction_date' => now(),
                'laundry_weight' => 6.0,
                'hpp_per_kg' => 7000,
                'total_hpp' => 42000,
                'total_price' => 60000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 6,
                'transaction_date' => now(),
                'laundry_weight' => 4.3,
                'hpp_per_kg' => 7000,
                'total_hpp' => 30100,
                'total_price' => 43000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 7,
                'transaction_date' => now(),
                'laundry_weight' => 8.0,
                'hpp_per_kg' => 7000,
                'total_hpp' => 56000,
                'total_price' => 80000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 8,
                'transaction_date' => now(),
                'laundry_weight' => 1.8,
                'hpp_per_kg' => 7000,
                'total_hpp' => 12600,
                'total_price' => 18000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 9,
                'transaction_date' => now(),
                'laundry_weight' => 9.4,
                'hpp_per_kg' => 7000,
                'total_hpp' => 65800,
                'total_price' => 94000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 10,
                'transaction_date' => now(),
                'laundry_weight' => 3.7,
                'hpp_per_kg' => 7000,
                'total_hpp' => 25900,
                'total_price' => 37000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
