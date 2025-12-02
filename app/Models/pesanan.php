<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
      protected $table = 'pesanan';
       protected $primaryKey = 'pesanan_id';

    protected $fillable = [
          'user_id',
          'meja_id',
          'nama_pelanggan',
          'no_hp',
          'menu_id',
          'jumlah',
          'catatan',
          'tanggal_pesanan',
          'total_harga',
          'status'
    ];

    public function menu()
    {
          return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function pelanggan()
    {
          return $this->belongsTo(Pelanggan::class, 'user_id');
    }
}
