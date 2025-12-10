<?php
namespace App\Http\Controllers;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Pelanggan;
use App\Models\StokMenu;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function pesan(Menu $menu)
    {
        // Cek apakah menu punya stok
        $stokMenu = StokMenu::where('menu_id', $menu->menu_id)->first();
        
        if (!$stokMenu || $stokMenu->jumlah_stok <= 0) {
            return redirect()->route('pelanggan.menu')
                ->with('error', 'Menu ini sedang tidak tersedia karena stok habis.');
        }
        
        return view('pelanggan.pesan', compact('menu', 'stokMenu'));
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

            // Cek stok sebelum membuat pesanan
            $stokMenu = StokMenu::where('menu_id', $menu->menu_id)->first();
            
            // Validasi menu harus punya stok
            if (!$stokMenu || $stokMenu->jumlah_stok <= 0) {
                return back()->withErrors([
                    'error' => 'Menu ini sedang tidak tersedia karena stok habis.'
                ])->withInput();
            }
            
            // Validasi stok cukup
            if ($stokMenu->jumlah_stok < $request->jumlah) {
                return back()->withErrors([
                    'jumlah' => 'Stok tidak mencukupi. Stok tersedia: ' . $stokMenu->jumlah_stok
                ])->withInput();
            }

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

            // Gunakan database transaction untuk memastikan konsistensi data
            DB::beginTransaction();
            try {
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

                // Kurangi stok setelah pesanan berhasil dibuat
                if ($stokMenu) {
                    $stokMenu->jumlah_stok -= $request->jumlah;
                    $stokMenu->save();
                }

                DB::commit();

                return redirect()->route('pelanggan.pesanan.show', $pesanan->pesanan_id)
                    ->with('success', 'Pesanan berhasil dibuat! Silakan bayar ke kasir.');
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->withErrors([
                    'error' => 'Terjadi kesalahan saat membuat pesanan. Silakan coba lagi.'
                ])->withInput();
            }
    }

    public function show($id)
    {
        $pesanan = Pesanan::where('pesanan_id', $id)->with('menu')->firstOrFail();
        return view('pelanggan.receipt', compact('pesanan'));
    }
}
