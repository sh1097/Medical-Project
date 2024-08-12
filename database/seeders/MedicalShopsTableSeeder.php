<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicalShopsTableSeeder extends Seeder
{
    public function run()
    {
        $medicalShops = [
            [
                'name' => 'HealthPlus Pharmacy',
                'description' => 'A trusted pharmacy for all your health needs.',
                'location' => '123 Main Street, Springfield',
            ],
            [
                'name' => 'Wellness Drug Store',
                'description' => 'Providing quality medicines at affordable prices.',
                'location' => '456 Elm Street, Springfield',
            ],
            [
                'name' => 'CarePlus Medical Supplies',
                'description' => 'Top-notch medical supplies for all your needs.',
                'location' => '789 Maple Avenue, Springfield',
            ],
            // Add more sample data as needed
        ];

        DB::table('medical_shops')->insert($medicalShops);
    }
}
