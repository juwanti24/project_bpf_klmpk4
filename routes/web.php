<?php
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminMenuController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdminAuthController::class, 'showLogin']); // home = login
Route::get('admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::get('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->middleware('admin.auth')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    // MENU - Super Admin Only
    Route::middleware('superadmin.auth')->group(function () {
        Route::get('menu', [AdminMenuController::class, 'index'])->name('admin.menu.index');
        Route::get('menu/create', [AdminMenuController::class, 'create'])->name('admin.menu.create');
        Route::post('menu/store', [AdminMenuController::class, 'store'])->name('admin.menu.store');
        Route::get('menu/edit/{id}', [AdminMenuController::class, 'edit'])->name('admin.menu.edit');
        Route::put('menu/update/{id}', [AdminMenuController::class, 'update'])->name('admin.menu.update');
        Route::delete('menu/delete/{id}', [AdminMenuController::class, 'destroy'])->name('admin.menu.destroy');
    });

    // PESANAN
    Route::get('pesanan', [App\Http\Controllers\AdminPesananController::class, 'index'])
        ->name('admin.pesanan.index');

    // SUPER ADMIN ROUTES
    Route::middleware('superadmin.auth')->prefix('superadmin')->group(function () {
        Route::get('/', [App\Http\Controllers\SuperAdminController::class, 'index'])->name('admin.superadmin.index');
        Route::get('create', [App\Http\Controllers\SuperAdminController::class, 'create'])->name('admin.superadmin.create');
        Route::post('store', [App\Http\Controllers\SuperAdminController::class, 'store'])->name('admin.superadmin.store');
        Route::get('edit/{id}', [App\Http\Controllers\SuperAdminController::class, 'edit'])->name('admin.superadmin.edit');
        Route::put('update/{id}', [App\Http\Controllers\SuperAdminController::class, 'update'])->name('admin.superadmin.update');
        Route::delete('destroy/{id}', [App\Http\Controllers\SuperAdminController::class, 'destroy'])->name('admin.superadmin.destroy');
    });

    // LAPORAN PENJUALAN
    Route::middleware('superadmin.auth')->prefix('laporan')->group(function () {
        Route::get('/', [App\Http\Controllers\LaporanPenjualanController::class, 'index'])->name('admin.laporan.index');
        Route::get('create', [App\Http\Controllers\LaporanPenjualanController::class, 'create'])->name('admin.laporan.create');
        Route::post('store', [App\Http\Controllers\LaporanPenjualanController::class, 'store'])->name('admin.laporan.store');
        Route::get('edit/{id}', [App\Http\Controllers\LaporanPenjualanController::class, 'edit'])->name('admin.laporan.edit');
        Route::put('update/{id}', [App\Http\Controllers\LaporanPenjualanController::class, 'update'])->name('admin.laporan.update');
        Route::delete('destroy/{id}', [App\Http\Controllers\LaporanPenjualanController::class, 'destroy'])->name('admin.laporan.destroy');
    });

    // STOK
    Route::middleware('superadmin.auth')->prefix('stok')->group(function () {
        Route::get('/', [App\Http\Controllers\StokController::class, 'index'])->name('admin.stok.index');
        Route::get('create', [App\Http\Controllers\StokController::class, 'create'])->name('admin.stok.create');
        Route::post('store', [App\Http\Controllers\StokController::class, 'store'])->name('admin.stok.store');
        Route::get('edit/{id}', [App\Http\Controllers\StokController::class, 'edit'])->name('admin.stok.edit');
        Route::put('update/{id}', [App\Http\Controllers\StokController::class, 'update'])->name('admin.stok.update');
        Route::delete('destroy/{id}', [App\Http\Controllers\StokController::class, 'destroy'])->name('admin.stok.destroy');
    });
});
