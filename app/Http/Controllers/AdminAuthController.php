<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            session([
                'admin_logged_in' => true,
                'admin_id' => $admin->admin_id,
                'admin_username' => $admin->username,
                'admin_role' => $admin->role,
            ]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['username' => 'Username atau password salah'])->withInput();
    }

    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_id', 'admin_username', 'admin_role']);
        return redirect()->route('admin.login');
    }
}
