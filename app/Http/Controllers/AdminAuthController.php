<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

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

        // Ambil admin berdasarkan username
        $admin = Admin::where('username', $request->username)->first();

        // Cek keberadaan admin dan password
        if ($admin && Hash::check($request->password, $admin->password)) {

            // Login Laravel
            Auth::login($admin);
            $request->session()->regenerate();

            // Cek role dan redirect sesuai role
            if ($admin->role === 'superadmin') {
                return redirect()->route('superadmin.dashboard');
            } else if ($admin->role === 'kasir') {
                return redirect()->route('admin.dashboard');
            }
        }

        return back()
            ->withErrors(['username' => 'Username atau password salah'])
            ->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
