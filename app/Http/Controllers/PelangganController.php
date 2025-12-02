<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Menu;
class PelangganController extends Controller
{
    public function daftar()
    {
        return view('pelanggan.daftar');
    }

    public function simpanPendaftaran(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
        ]);

        Pelanggan::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
        ]);

        session(['customer' => [
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
        ]]);

        return redirect()->route('pelanggan.menu')->with('success', 'Pendaftaran berhasil! Selamat datang, ' . $request->nama);
    }

    public function logout()
    {
        session()->forget('customer');
        return redirect()->route('pelanggan.daftar')->with('success', 'Anda telah logout.');
    }
    public function index(Request $request)
    {
        $query = Menu::query();
        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($qry) use ($q){
                $qry->where('nama_menu', 'like', "%$q%")
                    ->orWhere('deskripsi', 'like', "%$q%");
            });
        }
        $menu = $query->paginate(12);
        return view('pelanggan.menu', compact('menu'));
    }
}
