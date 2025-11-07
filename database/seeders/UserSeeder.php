<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin Epoy Store',
            'email' => 'admin@epoystore.com',
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jl. Admin No. 123, Jakarta',
            'password' => Hash::make('admin123'),
        ]);

        // Create Customer Demo
        User::create([
            'name' => 'Customer Demo',
            'email' => 'customer@example.com',
            'role' => 'customer',
            'phone' => '081298765432',
            'address' => 'Jl. Customer No. 456, Jakarta',
            'password' => Hash::make('customer123'),
        ]);
    }
}