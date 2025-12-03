<?php
namespace App\Http\Controllers;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function pesan(Menu $menu)
    {
        return view('pelanggan.pesan', compact('menu'));
    }
    public function simpan(Request $request)
    {
            $request->validate([
                'menu_id' => 'required',
                'jumlah' => 'required|numeric|min:1',
                'catatan' => 'nullable',
                'nomor_meja' => 'required|string|max:10',
            ]);

            $menu = Menu::findOrFail($request->menu_id);

            // ambil data pelanggan dari request atau session
            $nama = $request->input('nama_pelanggan') ?? session('customer.nama') ?? 'Tamu';
            $noHp = $request->input('no_hp') ?? session('customer.no_hp') ?? '';

            // find existing pelanggan by name + phone or create one
            $pelanggan = Pelanggan::firstOrCreate([
                'nama' => $nama,
                'no_hp' => $noHp,
            ]);

            // cari atau buat meja sesuai nomor_meja yang diinput pelanggan
            $nomorMeja = $request->input('nomor_meja');
            $mejaId = DB::table('meja')->where('nomor_meja', $nomorMeja)->value('meja_id');
            if (!$mejaId) {
                $mejaId = DB::table('meja')->insertGetId([
                    'nomor_meja' => $nomorMeja,
                    'created_at' => now(),
                    'updated_at' => now()
                ], 'meja_id');
            }

            // buat pesanan dengan user_id yang referensi pelanggan_id
            $pesanan = Pesanan::create([
                'user_id' => $pelanggan->pelanggan_id,
                'meja_id' => $mejaId,
                'nama_pelanggan' => $nama,
                'no_hp' => $noHp,
                'menu_id' => $menu->menu_id,
                'jumlah' => $request->jumlah,
                'catatan' => $request->catatan,
                'tanggal_pesanan' => now()->toDateString(),
                'total_harga' => $menu->harga * $request->jumlah,
                'status' => 'Menunggu'
            ]);

            return redirect()->route('pelanggan.pesanan.show', $pesanan->pesanan_id)
                ->with('success', 'Pesanan berhasil dibuat! Silakan bayar ke kasir.');
    }

    public function show($id)
    {
        $pesanan = Pesanan::where('pesanan_id', $id)->with('menu')->firstOrFail();
        return view('pelanggan.receipt', compact('pesanan'));
    }
}
