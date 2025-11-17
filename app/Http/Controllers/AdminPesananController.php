<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ===== DATA DUMMY MENGIKUTI STRUKTUR TABEL =====
        $pesanan = [
            [
                'pesanan_id' => 1,
                'meja' => ['meja_id' => 1, 'nomor_meja' => 'Meja 1'],
                'tanggal_pesanan' => '2025-01-10',
                'detail' => [
                    [
                        'menu' => ['menu_id' => 1, 'nama_menu' => 'Nasi Goreng'],
                        'jumlah' => 2,
                        'subtotal' => 30000
                    ],
                    [
                        'menu' => ['menu_id' => 2, 'nama_menu' => 'Es Teh'],
                        'jumlah' => 1,
                        'subtotal' => 5000
                    ]
                ]
            ],
            [
                'pesanan_id' => 2,
                'meja' => ['meja_id' => 3, 'nomor_meja' => 'Meja 3'],
                'tanggal_pesanan' => '2025-01-11',
                'detail' => [
                    [
                        'menu' => ['menu_id' => 3, 'nama_menu' => 'Ayam Geprek'],
                        'jumlah' => 1,
                        'subtotal' => 18000
                    ]
                ]
            ],
        ];

        return view('admin.pesanan.index', compact('pesanan'));
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
