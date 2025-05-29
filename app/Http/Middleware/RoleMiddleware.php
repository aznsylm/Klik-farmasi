<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Jika route adalah addPasien, izinkan akses untuk admin dan super_admin
        if ($request->route()->getName() === 'superadmin.addPasien' && 
            Auth::check() && 
            (Auth::user()->role === 'super_admin' || Auth::user()->role === 'admin')) {
            return $next($request);
        }
        
        // Untuk route lainnya, periksa role seperti biasa
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        abort(403, 'Unauthorized action. Check your role.');
    }
}