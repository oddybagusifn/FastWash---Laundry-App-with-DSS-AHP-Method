<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RawMaterialSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('raw_materials')->insert([
            [
                'item_name' => 'Detergent',
                'item_category' => 'Cleaning',
                'stock' => 100,
                'price' => 25000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => 'Fabric Softener',
                'item_category' => 'Cleaning',
                'stock' => 80,
                'price' => 30000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => 'Bleach',
                'item_category' => 'Cleaning',
                'stock' => 60,
                'price' => 22000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => 'Liquid Detergent',
                'item_category' => 'Cleaning',
                'stock' => 90,
                'price' => 28000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => 'Stain Remover',
                'item_category' => 'Cleaning',
                'stock' => 50,
                'price' => 35000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => 'Laundry Bag',
                'item_category' => 'Equipment',
                'stock' => 40,
                'price' => 15000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => 'Hanger',
                'item_category' => 'Equipment',
                'stock' => 200,
                'price' => 3000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => 'Plastic Wrap',
                'item_category' => 'Packaging',
                'stock' => 120,
                'price' => 10000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => 'Perfume Laundry',
                'item_category' => 'Fragrance',
                'stock' => 70,
                'price' => 40000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_name' => 'Iron Spray',
                'item_category' => 'Finishing',
                'stock' => 65,
                'price' => 27000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
