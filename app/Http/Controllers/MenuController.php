<?php
namespace App\Http\Controllers;
use App\Models\MenuItem;
use Illuminate\Http\Request;
class MenuController extends Controller
{
    public function index(Request $request)
{
    $kategori = $request->query('kategori');
    $menus = MenuItem::when($kategori, function ($query) use ($kategori) {
        return $query->where('category', $kategori);
    })->get();

    return view('pelanggan.menu', compact('menus', 'kategori'));
}
}