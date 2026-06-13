<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([

            'nama' => 'Administrator',

            'email' => 'admin@splj.com',

            'password' => Hash::make('admin123'),

            'role' => 'admin',

            'membership' => 'regular',

            'poin' => 0

        ]);
    }
}