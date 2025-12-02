<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'nama_menu' => 'Nasi Goreng Spesial',
                'kategori' => 'makanan',
                'deskripsi' => 'Nasi goreng dengan telur, ayam suwir, dan bumbu rahasia.',
                'harga' => 25000,
                'gambar_menu' => null,
            ],
            [
                'nama_menu' => 'Mie Ayam Pangsit',
                'kategori' => 'makanan',
                'deskripsi' => 'Mie ayam porsian lengkap dengan pangsit goreng.',
                'harga' => 20000,
                'gambar_menu' => null,
            ],
            [
                'nama_menu' => 'Es Teh Manis',
                'kategori' => 'minuman',
                'deskripsi' => 'Teh manis dingin dengan es batu.',
                'harga' => 5000,
                'gambar_menu' => null,
            ],
            [
                'nama_menu' => 'Cappuccino',
                'kategori' => 'minuman',
                'deskripsi' => 'Espresso dengan susu dan foam lembut.',
                'harga' => 18000,
                'gambar_menu' => null,
            ],
            [
                'nama_menu' => 'Pancake Blueberry',
                'kategori' => 'makanan',
                'deskripsi' => 'Pancake empuk dengan saus blueberry.',
                'harga' => 22000,
                'gambar_menu' => null,
            ],
        ];

        foreach ($items as $i) {
            Menu::create($i);
        }
    }
}
