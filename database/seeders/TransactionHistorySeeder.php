<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionHistorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('transaction_histories')->insert([
            [
                'laundry_transaction_id' => 1,
                'customer_name' => 'John Doe',
                'phone_number' => '081234567890',
                'laundry_weight' => 5.5,
                'total_price' => 55000,
                'created_at' => now(),
            ],
        ]);
    }
}
