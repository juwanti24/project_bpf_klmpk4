<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokMenu extends Model
{
    use HasFactory;

    protected $table = 'stok_menu';
    protected $primaryKey = 'stok_id';

    protected $fillable = [
        'menu_id',
        'jumlah_stok',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'menu_id');
    }
}

