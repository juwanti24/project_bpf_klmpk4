<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'username' => 'superadmin',
            'password' => Hash::make('admin123'),  // password untuk login
            'role'     => 'superadmin',
        ]);

        Admin::create([
            'username' => 'kasir1',
            'password' => Hash::make('kasir123'),
            'role'     => 'kasir',
        ]);
    }
}
