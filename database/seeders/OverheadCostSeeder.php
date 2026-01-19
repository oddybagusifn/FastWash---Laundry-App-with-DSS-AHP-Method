<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OverheadCostSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['Electricity', 500000],
            ['Water', 300000],
            ['Internet', 450000],
            ['Gas', 250000],
            ['Maintenance', 600000],
            ['Cleaning Service', 400000],
            ['Office Supplies', 350000],
            ['Security', 550000],
            ['Insurance', 700000],
            ['Miscellaneous', 200000],
        ];

        foreach ($data as $item) {
            DB::table('overhead_costs')->insert([
                'cost_name' => $item[0],
                'cost_amount' => $item[1],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
