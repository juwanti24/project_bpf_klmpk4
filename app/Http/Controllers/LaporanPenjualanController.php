<?php

namespace App\Http\Controllers;

use App\Models\LaporanPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LaporanPenjualanController extends Controller
{

    public function index()
    {
        $laporans = LaporanPenjualan::orderBy('bulan', 'desc')->get();
        
        // Calculate totals
        $totalPesanan = $laporans->sum('total_pesanan');
        $totalPenjualan = $laporans->sum('total_penjualan');
        
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

