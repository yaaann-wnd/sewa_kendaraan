<?php

namespace Database\Seeders;

use App\Models\Kendaraan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KendaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kendaraans = [
            [
                'nama_kendaraan' => 'Truck HINO 245GT'
            ],
            [
                'nama_kendaraan' => 'Ferrari LaFerrari'
            ],
            [
                'nama_kendaraan' => 'Porsche Cayman GT4 RS'
            ],
        ];

        foreach ($kendaraans as $kendaraan) {
            Kendaraan::insert([
                'nama_kendaraan' => $kendaraan['nama_kendaraan']
            ]);
        }
    }
}
