<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Super Admin
        Admin::create([
            'username' => 'superadmin',
            'email' => 'superadmin@example.com',
            'nama_lengkap' => 'Super Administrator',
            'password' => Hash::make('superadmin123'),
            'role' => 'super_admin',
        ]);

        // Create Regular Admin (optional)
        Admin::create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'nama_lengkap' => 'Administrator',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
    }
}

