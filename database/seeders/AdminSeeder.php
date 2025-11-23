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
    'username' => 'yahya24ti',
    'email'    => 'yahya24ti@mahasiswa.pcr.ac.id',
    'password' => Hash::make('admin123'),
    'role'     => 'superadmin',
]);

Admin::create([
    'username' => 'superadmin',
    'email'    => 'superadmin@dummy.com',
    'password' => Hash::make('admin123'),
    'role'     => 'superadmin',
]);

Admin::create([
    'username' => 'kasir1',
    'email'    => 'kasir1@example.com',
    'password' => Hash::make('kasir123'),
    'role'     => 'kasir',
]);

    }
}
