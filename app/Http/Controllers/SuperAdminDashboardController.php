<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Menu;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use App\Models\StokMenu;

class SuperAdminDashboardController extends Controller
{
    public function index()
    {
        $totalMenu = Menu::count();
        $totalPesanan = Pesanan::count();
        $totalStok = StokMenu::sum('jumlah_stok');
        $totalAdmin = Admin::count();
        $totalPelanggan = Pelanggan::count();
        $totalPenjualan = Pesanan::sum('total_harga') ?? 0;
        $pesananHariIni = Pesanan::whereDate('tanggal_pesanan', today())->count();
        $penjualanHariIni = Pesanan::whereDate('tanggal_pesanan', today())->sum('total_harga') ?? 0;

        return view('superadmin.dashboard', compact(
            'totalMenu',
            'totalPesanan',
            'totalStok',
            'totalAdmin',
            'totalPelanggan',
            'totalPenjualan',
            'pesananHariIni',
            'penjualanHariIni'
        ));
    }
}

