<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Case-insensitive username search
        $admin = Admin::whereRaw('LOWER(username) = ?', [strtolower($request->username)])->first();

        if (!$admin) {
            return back()
                ->withErrors(['username' => 'Username atau password salah'])
                ->withInput();
        }

        // Check password
        if (!Hash::check($request->password, $admin->password)) {
            return back()
                ->withErrors(['username' => 'Username atau password salah'])
                ->withInput();
        }

        // Login successful
        Auth::guard('admin')->login($admin);
        $request->session()->put('admin_id', $admin->admin_id);
        $request->session()->put('admin_role', $admin->role);
        $request->session()->regenerate();

        if ($admin->role === 'superadmin') {
            return redirect()->route('superadmin.dashboard');
        } else if ($admin->role === 'kasir') {
            return redirect()->route('admin.dashboard');
        }

        // Default redirect if role doesn't match
        return redirect()->route('admin.dashboard');
    }

    public function redirectToGoogle()
    {
        // Pastikan kredensial Google tersedia
        if (!env('GOOGLE_CLIENT_ID') || !env('GOOGLE_CLIENT_SECRET')) {
            return redirect()->route('admin.login')
                ->withErrors(['google' => 'Google OAuth belum dikonfigurasi di .env']);
        }

        // Redirect ke Google (default redirect sudah dibaca dari services.php)
        return Socialite::driver('google')
            ->scopes(['openid', 'profile', 'email'])
            ->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            // InvalidStateException kerap muncul jika state tidak cocok
            $googleUser = Socialite::driver('google')
                ->stateless()
                ->user();

            if (!$googleUser || !$googleUser->getEmail()) {
                return redirect()->route('admin.login')
                    ->with('error', 'Email Google tidak ditemukan.');
            }

            $emailUser = strtolower($googleUser->getEmail());

            // Coba cari berdasarkan google_id terlebih dahulu, fallback ke email (case-insensitive)
            $admin = Admin::where('google_id', $googleUser->getId())
                ->orWhereRaw('LOWER(email) = ?', [$emailUser])
                ->first();

            if (!$admin) {
                return redirect()->route('admin.login')
                    ->with('error', 'Akun tidak terdaftar sebagai admin: ' . $googleUser->getEmail());
            }

            if ($admin->role !== 'superadmin') {
                return redirect()->route('admin.login')
                    ->with('error', 'Login Google hanya untuk superadmin.');
            }

            // Simpan google_id & email jika belum terisi agar login berikutnya konsisten
            if (!$admin->google_id) {
                $admin->google_id = $googleUser->getId();
            }
            if (!$admin->email) {
                $admin->email = $googleUser->getEmail();
            }
            if ($admin->isDirty()) {
                $admin->save();
            }

            Auth::guard('admin')->login($admin);
            $request->session()->put('admin_id', $admin->admin_id);
            $request->session()->put('admin_role', $admin->role);
            $request->session()->regenerate();

            return redirect()->route('superadmin.dashboard');
        } catch (InvalidStateException $e) {
            Log::warning('Google OAuth state mismatch', ['message' => $e->getMessage()]);

            return redirect()->route('admin.google')
                ->with('error', 'Sesi Google kadaluarsa, silakan coba lagi.');
        } catch (\Exception $e) {
            \Log::error('Google OAuth Error: ' . $e->getMessage());

            return redirect()->route('admin.login')
                ->with('error', 'Terjadi kesalahan login Google.');
        }
    }




    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->forget(['admin_id', 'admin_role']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }



}

