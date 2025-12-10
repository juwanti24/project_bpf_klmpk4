<?php
namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\StokMenu;
use App\Models\Admin;
use App\Models\Pelanggan;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalMenu = Menu::count();
        $totalPesanan = Pesanan::count();
        $totalStok = StokMenu::sum('jumlah_stok');
        $totalAdmin = Admin::count();
        $totalPelanggan = Pelanggan::count();
        $totalPenjualan = Pesanan::sum('total_harga') ?? 0;
        
        // Pesanan hari ini
        $pesananHariIni = Pesanan::whereDate('tanggal_pesanan', today())->count();
        $penjualanHariIni = Pesanan::whereDate('tanggal_pesanan', today())->sum('total_harga') ?? 0;

        return view('admin.dashboard', compact(
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
