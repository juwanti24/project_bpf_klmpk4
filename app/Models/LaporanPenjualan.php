<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPenjualan extends Model
{
    use HasFactory;

    protected $table = 'laporan_penjualan';
    protected $primaryKey = 'laporan_id';

    protected $fillable = [
        'bulan',
        'total_pesanan',
        'total_penjualan',
    ];

    protected $casts = [
        'total_penjualan' => 'decimal:2',
    ];
}

