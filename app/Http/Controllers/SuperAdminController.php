<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SuperAdminController extends Controller
{

    public function index()
    {
        $admins = Admin::all();
        return view('admin.superadmin.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.superadmin.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:admin,username',
            'email' => 'nullable|email|max:255',
            'nama_lengkap' => 'nullable|string|max:255',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,super_admin',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Admin::create([
            'username' => $request->username,
            'email' => $request->email,
            'nama_lengkap' => $request->nama_lengkap,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.superadmin.index')->with('success', 'Akun admin berhasil dibuat!');
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.superadmin.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:admin,username,' . $id . ',admin_id',
            'email' => 'nullable|email|max:255',
            'nama_lengkap' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6',
            'role' => 'required|in:admin,super_admin',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = [
            'username' => $request->username,
            'email' => $request->email,
            'nama_lengkap' => $request->nama_lengkap,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return redirect()->route('admin.superadmin.index')->with('success', 'Akun admin berhasil diupdate!');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        
        // Prevent deleting yourself
        if ($admin->admin_id == session('admin_id')) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri!');
        }

        $admin->delete();

        return redirect()->route('admin.superadmin.index')->with('success', 'Akun admin berhasil dihapus!');
    }
}

