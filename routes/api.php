<?php

use App\Http\Controllers\AdminAuthController;
use Illuminate\Support\Facades\Route;

// API Routes untuk Admin Authentication
Route::prefix('admin/auth')->group(function () {
    // Get Google OAuth URL
    Route::get('google/url', [AdminAuthController::class, 'apiGetGoogleAuthUrl']);
    
    // Login dengan Google menggunakan access token
    Route::post('google', [AdminAuthController::class, 'apiLoginWithGoogle']);
});

