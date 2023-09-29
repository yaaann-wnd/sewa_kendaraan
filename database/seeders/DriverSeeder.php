<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $drivers = [
            [
                'nama_driver' => 'Amirah Maimun'
            ],
            [
                'nama_driver' => 'Seungwan'
            ],
            [
                'nama_driver' => 'Jihyo'
            ],
        ];

        foreach ($drivers as $driver) {
            Driver::insert([
                'nama_driver' => $driver['nama_driver']
            ]);
        }
    }
}
