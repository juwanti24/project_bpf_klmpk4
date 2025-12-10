<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SuperAdminOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('admin')->user();

        if (!$user) {
            return redirect()
                ->route('admin.login')
                ->with('error', 'Silahkan login terlebih dahulu!');
        }

        if ($user->role !== 'superadmin') {
            return redirect()
                ->route('admin.login')
                ->with('error', 'Halaman ini hanya bisa diakses oleh superadmin!');
        }

        return $next($request);
    }
}
