<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;

class SuperAdminPesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::with(['meja', 'menu'])
            ->orderBy('pesanan_id', 'DESC')
            ->get();

        return view('superadmin.pesanan.index', compact('pesanan'));
    }
}

