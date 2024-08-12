<?php

// database/seeders/ProductsTableSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        // Insert sample data into the products table
        DB::table('products')->insert([
            [
                'medical_shop_id' => 1, // Ensure this ID exists in the medical_shops table
                'name' => 'Aspirin',
                'description' => 'Pain reliever and fever reducer.',
                'price' => 9.99,
            ],
            [
                'medical_shop_id' => 2,
                'name' => 'Cough Syrup',
                'description' => 'Relieves cough and throat irritation.',
                'price' => 5.49,
            ],
            [
                'medical_shop_id' => 1,
                'name' => 'Band-Aids',
                'description' => 'Assorted bandages for minor cuts and scrapes.',
                'price' => 3.99,
            ],
        ]);
    }
}

