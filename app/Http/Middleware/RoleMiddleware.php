<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            abort(403);
        }

        // Samakan case supaya tidak gagal karena beda huruf (Petugas vs petugas)
        $userRole = strtolower((string) Auth::user()->role);
        $requiredRole = strtolower((string) $role);

        if ($userRole === $requiredRole) {
            return $next($request);
        }

        abort(403);
    }
}