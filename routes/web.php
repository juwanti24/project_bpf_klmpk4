<?php
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\AdminPesananController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\SuperAdminDashboardController;
use App\Http\Controllers\SuperAdminMenuController;
use App\Http\Controllers\SuperAdminPesananController;
use App\Http\Controllers\SuperAdminStokController;
use App\Http\Controllers\SuperAdminLaporanPenjualanController;
use App\Http\Middleware\AdminOnly;
use Illuminate\Support\Facades\Route;


// Default: pelanggan daftar
Route::get('/', function() {
    return redirect()->route('pelanggan.daftar');
});
Route::get('admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::get('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
Route::get('superadmin/logout', [AdminAuthController::class, 'logout'])->name('superadmin.logout');

Route::get('/auth/google', [AdminAuthController::class, 'redirectToGoogle'])
    ->name('admin.google');

Route::get('/auth/google/callback', [AdminAuthController::class, 'handleGoogleCallback'])
    ->name('admin.google.callback');


// Route test untuk debugging - hapus setelah selesai
Route::get('test-google-callback', function(\Illuminate\Http\Request $request) {
    \Log::info('TEST CALLBACK DIPANGGIL', ['url' => $request->fullUrl()]);
    return response()->json([
        'message' => 'Route test berhasil diakses',
        'url' => $request->fullUrl(),
        'time' => now()
    ]);
});

// ADMIN PANEL
Route::prefix('admin')
    ->middleware([\App\Http\Middleware\OnlyAdmin::class])
    ->group(function () {

    Route::get('dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::resource('menu', AdminMenuController::class, ['as' => 'admin']);
    Route::get('pesanan', [AdminPesananController::class, 'index'])->name('admin.pesanan.index');
    Route::resource('stok', StokController::class, ['as' => 'admin']);
    Route::resource('laporan', LaporanPenjualanController::class, ['as' => 'admin']);
});


// SUPERADMIN PANEL
Route::prefix('superadmin')
    ->name('superadmin.')
    ->middleware([\App\Http\Middleware\SuperAdminOnly::class])
    ->group(function () {

    Route::get('dashboard', [SuperAdminDashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('admins', SuperAdminController::class);
    Route::resource('menu', SuperAdminMenuController::class);
    Route::get('pesanan', [SuperAdminPesananController::class, 'index'])->name('pesanan.index');
    Route::resource('stok', SuperAdminStokController::class);
    Route::resource('laporan', SuperAdminLaporanPenjualanController::class);
});


// PUBLIC PELANGGAN
Route::get('pelanggan/daftar', [PelangganController::class, 'daftar'])->name('pelanggan.daftar');
Route::post('pelanggan/daftar', [PelangganController::class, 'simpanPendaftaran'])->name('pelanggan.simpan');
Route::get('pelanggan/logout', [PelangganController::class, 'logout'])->name('pelanggan.logout');
// MENU UNTUK PELANGGAN (READ + FILTER + SEARCH)

// MENU UNTUK PELANGGAN (READ ONLY)
Route::get('menu', [AdminMenuController::class, 'publicIndex'])->name('pelanggan.menu');

// PESAN MENU
Route::get('pesanan/{menu}', [PesananController::class, 'pesan'])->name('pelanggan.pesan');
Route::post('pesanan', [PesananController::class, 'simpan'])->name('pelanggan.pesan.simpan');
Route::get('pesanan/{id}/terima', [PesananController::class, 'show'])->name('pelanggan.pesanan.show');
