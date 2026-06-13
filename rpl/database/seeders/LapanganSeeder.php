<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lapangan;

class LapanganSeeder extends Seeder
{
    public function run(): void
    {
        Lapangan::insert([

            [
                'nama_lapangan' => 'Futsal A',
                'jenis_olahraga' => 'Futsal',
                'harga_per_jam' => 150000,
                'status' => 'aktif'
            ],

            [
                'nama_lapangan' => 'Futsal B',
                'jenis_olahraga' => 'Futsal',
                'harga_per_jam' => 180000,
                'status' => 'aktif'
            ],

            [
                'nama_lapangan' => 'Badminton 1',
                'jenis_olahraga' => 'Badminton',
                'harga_per_jam' => 50000,
                'status' => 'aktif'
            ],

            [
                'nama_lapangan' => 'Badminton 2',
                'jenis_olahraga' => 'Badminton',
                'harga_per_jam' => 50000,
                'status' => 'aktif'
            ],

            [
                'nama_lapangan' => 'Basket Indoor',
                'jenis_olahraga' => 'Basket',
                'harga_per_jam' => 250000,
                'status' => 'aktif'
            ]

        ]);
    }
}