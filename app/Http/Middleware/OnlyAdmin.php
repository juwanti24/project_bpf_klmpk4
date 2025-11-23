<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class OnlyAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('admin')->user();

        // Jika tidak login
        if (!$user) {
            return redirect()
                ->route('admin.login')
                ->with('error', 'Silahkan login sebagai admin!');
        }

        // Jika role bukan kasir
        if ($user->role !== 'kasir') {
            return redirect()
                ->route('admin.login')
                ->with('error', 'Anda tidak memiliki akses ke halaman admin!');
        }

        return $next($request);
    }
}
