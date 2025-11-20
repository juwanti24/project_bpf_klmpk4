<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminMenuController;
use App\Http\Middleware\CheckIsLogin;
use Illuminate\Support\Facades\Route;

// Public (tanpa login)
Route::get('/', [AdminAuthController::class, 'showLogin']);
Route::get('admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::get('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Protected (harus login)
Route::prefix('admin')
    ->middleware(CheckIsLogin::class) // <--- middleware diterapkan di sini
    ->group(function () {

        Route::get('dashboard', [AdminDashboardController::class, 'index'])
            ->name('admin.dashboard');

        // MENU
        Route::resource('menu', AdminMenuController::class, ['as' => 'admin']);

        // PESANAN
        Route::get('pesanan', [App\Http\Controllers\AdminPesananController::class, 'index'])
            ->name('admin.pesanan.index');

        Route::get('menu', [AdminMenuController::class, 'index'])->name('admin.menu.index');
        Route::get('menu/create', [AdminMenuController::class, 'create'])->name('admin.menu.create');
        Route::post('menu/store', [AdminMenuController::class, 'store'])->name('admin.menu.store');
        Route::get('menu/edit/{id}', [AdminMenuController::class, 'edit'])->name('admin.menu.edit');
        Route::put('menu/update/{id}', [AdminMenuController::class, 'update'])->name('admin.menu.update');
        Route::delete('menu/delete/{id}', [AdminMenuController::class, 'destroy'])->name('admin.menu.destroy');
    });

// Duplicate menu route (bisa dihapus)
Route::get('menu', [AdminMenuController::class, 'index'])->name('admin.menu.index');
