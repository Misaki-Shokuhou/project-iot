<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Cek apakah pengguna sudah login dan memiliki role yang sesuai
        if (auth()->check() && auth()->user()->role === $role) {
            return $next($request);
        }

        // Jika tidak, tampilkan halaman custom error
        return response()->view('other.error-user', [], 403);
    }
}
