<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
                'role_id' => 1
            ],
            [
                'name' => 'Atasan',
                'email' => 'atasan@atasan.com',
                'password' => Hash::make('atasan'),
                'role_id' => 2
            ],
            [
                'name' => 'Direktur',
                'email' => 'direktur@direktur.com',
                'password' => Hash::make('direktur'),
                'role_id' => 3
            ],
        ];

        foreach ($users as $user) {
            User::insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
                'role_id' => $user['role_id']
            ]);
        }
    }
}
