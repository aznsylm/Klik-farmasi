<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!User::isCurrentUserSuperAdmin()) {
            abort(403, 'Unauthorized. Super Admin access required.');
        }

        return $next($request);
    }
}