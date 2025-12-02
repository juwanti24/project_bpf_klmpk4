<?php

namespace App\Http\Controllers;

use App\Models\StokMenu;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StokController extends Controller
{

    public function index()
    {
        $stoks = StokMenu::with('menu')->get();
        return view('admin.stok.index', compact('stoks'));
    }

    public function create()
    {
        $menus = Menu::all();
        return view('admin.stok.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu_id' => 'required|exists:menu,menu_id',
            'jumlah_stok' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Check if stok already exists for this menu
        $existingStok = StokMenu::where('menu_id', $request->menu_id)->first();
        
        if ($existingStok) {
            $existingStok->jumlah_stok += $request->jumlah_stok;
            $existingStok->save();
        } else {
            StokMenu::create($request->all());
        }

        return redirect()->route('admin.stok.index')->with('success', 'Stok berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $stok = StokMenu::with('menu')->findOrFail($id);
        $menus = Menu::all();
        return view('admin.stok.edit', compact('stok', 'menus'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'menu_id' => 'required|exists:menu,menu_id',
            'jumlah_stok' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $stok = StokMenu::findOrFail($id);
        $stok->update($request->all());

        return redirect()->route('admin.stok.index')->with('success', 'Stok berhasil diupdate!');
    }

    public function destroy($id)
    {
        $stok = StokMenu::findOrFail($id);
        $stok->delete();

        return redirect()->route('admin.stok.index')->with('success', 'Stok berhasil dihapus!');
    }
}
