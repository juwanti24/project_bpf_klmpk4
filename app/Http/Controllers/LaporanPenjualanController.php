<?php

namespace App\Http\Controllers;

use App\Models\LaporanPenjualan;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class LaporanPenjualanController extends Controller
{

    public function index()
    {
        // Hitung laporan dari data pesanan real-time
        // Group by bulan menggunakan DATE_FORMAT untuk MySQL atau strftime untuk SQLite
        $laporans = Pesanan::select(
                DB::raw('DATE_FORMAT(tanggal_pesanan, "%Y-%m") as bulan'),
                DB::raw('COUNT(*) as total_pesanan'),
                DB::raw('SUM(total_harga) as total_penjualan')
            )
            ->whereNotNull('tanggal_pesanan')
            ->groupBy('bulan')
            ->orderBy('bulan', 'desc')
            ->get();
        
        // Calculate totals dari semua pesanan
        $totalPesanan = Pesanan::count();
        $totalPenjualan = Pesanan::sum('total_harga') ?? 0;
        
        return view('admin.laporan.index', compact('laporans', 'totalPesanan', 'totalPenjualan'));
    }

    public function create()
    {
        return view('admin.laporan.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bulan' => 'required|string|max:255',
            'total_pesanan' => 'required|integer|min:0',
            'total_penjualan' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        LaporanPenjualan::create($request->all());

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan penjualan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $laporan = LaporanPenjualan::findOrFail($id);
        return view('admin.laporan.edit', compact('laporan'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'bulan' => 'required|string|max:255',
            'total_pesanan' => 'required|integer|min:0',
            'total_penjualan' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $laporan = LaporanPenjualan::findOrFail($id);
        $laporan->update($request->all());

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan penjualan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $laporan = LaporanPenjualan::findOrFail($id);
        $laporan->delete();

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan penjualan berhasil dihapus!');
    }
}
