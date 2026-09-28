<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Administrator',
                'email' => 'admin@petcare.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Petugas Kasir',
                'email' => 'kasir@petcare.com',
                'password' => Hash::make('password123'),
                'role' => 'kasir',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pelanggan Setia',
                'email' => 'customer@petcare.com',
                'password' => Hash::make('password123'),
                'role' => 'customer',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
