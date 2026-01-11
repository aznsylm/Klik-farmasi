<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'superadmin') {
            return redirect()->route('login')->with('error', 'Akses ditolak. Anda tidak memiliki izin SuperAdmin.');
        }

        return $next($request);
    }
}