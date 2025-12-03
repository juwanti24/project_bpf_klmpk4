<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\AdminPesananController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\MenuController;

use Illuminate\Support\Facades\Route;

// Default: pelanggan daftar
Route::get('/', function() {
    return redirect()->route('pelanggan.daftar');
});
Route::get('admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::get('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// ADMIN PANEL
Route::prefix('admin')->group(function () {

    Route::get('dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    // MENU
    Route::resource('menu', AdminMenuController::class, ['as' => 'admin']);

    // PESANAN ADMIN
    Route::get('pesanan', [AdminPesananController::class, 'index'])
        ->name('admin.pesanan.index');

    // SUPERADMIN
    Route::prefix('superadmin')->group(function () {

        Route::get('/', [SuperAdminController::class, 'index'])
            ->name('admin.superadmin.index');

        Route::get('create', [SuperAdminController::class, 'create'])
            ->name('admin.superadmin.create');

        Route::post('store', [SuperAdminController::class, 'store'])
            ->name('admin.superadmin.store');

        Route::get('edit/{id}', [SuperAdminController::class, 'edit'])
            ->name('admin.superadmin.edit');

        Route::put('update/{id}', [SuperAdminController::class, 'update'])
            ->name('admin.superadmin.update');

        Route::delete('destroy/{id}', [SuperAdminController::class, 'destroy'])
            ->name('admin.superadmin.destroy');
    });
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
