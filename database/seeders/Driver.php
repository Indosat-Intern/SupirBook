<?php

namespace Database\Seeders;

use App\Models\Driver as ModelsDriver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Driver extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsDriver::create([
            'name' => 'Test Driver',
            'car_type' => 'Sedan',
            'phone' => '08123456789',
            'status' => 'active',
        ]);
    }
}
