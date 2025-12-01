<?php
namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminMenuController extends Controller
{

   public function index(Request $request)
{
    $kategori = $request->kategori;
    $search = $request->search;

    $menus = Menu::when($kategori, function ($query) use ($kategori) {
            $query->where('kategori', $kategori);
        })
        ->when($search, function ($query) use ($search) {
            $query->where('nama_menu', 'like', "%{$search}%"); // hanya nama_menu
        })
        ->paginate(10);

    $menus->appends([
        'kategori' => $kategori,
        'search' => $search
    ]);

    $listKategori = Menu::select('kategori')->distinct()->get();

    return view('admin.menu.index', compact('menus', 'listKategori', 'kategori', 'search'));
}


    public function create()
    {
        return view('admin.menu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_menu'   => 'required|string|max:255',
            'kategori'    => 'required|string|max:100',
            'deskripsi'   => 'nullable|string',
            'harga'       => 'required|numeric',
            'gambar_menu' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar_menu')) {
            $data['gambar_menu'] = $request->file('gambar_menu')->store('menu_images', 'public');
        }

        Menu::create($data);

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menu.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_menu'   => 'required|string|max:255',
            'kategori'    => 'required|string|max:100',
            'deskripsi'   => 'nullable|string',
            'harga'       => 'required|numeric',
            'gambar_menu' => 'nullable|image|max:2048',
        ]);

        $menu = Menu::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('gambar_menu')) {
            if ($menu->gambar_menu) {
                Storage::disk('public')->delete($menu->gambar_menu);
            }
            $data['gambar_menu'] = $request->file('gambar_menu')->store('menu_images', 'public');
        }

        $menu->update($data);

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil diupdate!');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        if ($menu->gambar_menu) {
            Storage::disk('public')->delete($menu->gambar_menu);
        }
        $menu->delete();

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil dihapus!');
    }
}
