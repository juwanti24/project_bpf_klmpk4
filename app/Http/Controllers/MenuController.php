<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->kategori;
        $search = $request->search;

        $menus = Menu::when($kategori, function ($query) use ($kategori) {
                $query->where('kategori', $kategori);
            })
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_menu', 'like', "%{$search}%")
                      ->orWhere('deskripsi', 'like', "%{$search}%");
                });
            })
            ->paginate(6);

        // Tambahkan query agar pagination tidak reset
        $menus->appends([
            'kategori' => $kategori,
            'search' => $search
        ]);

        $listKategori = Menu::select('kategori')->distinct()->get();

        return view('menu.index', compact('menus', 'listKategori', 'kategori', 'search'));
    }
}
