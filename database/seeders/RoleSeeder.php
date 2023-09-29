<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'nama_role' => 'Admin'
            ],
            [
                'nama_role' => 'Penyetuju 1'
            ],
            [
                'nama_role' => 'Penyetuju 2'
            ],
        ];

        foreach ($roles as $role) {
            Role::insert([
                'nama_role' => $role['nama_role']
            ]);
        }
    }
}
