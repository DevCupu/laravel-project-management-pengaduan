<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifiedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Jika user adalah 'user' biasa dan BELUM terverifikasi, tolak
        if ($user && $user->role === 'user' && !$user->is_verified) {
            abort(403, 'Akun Anda belum diverifikasi oleh admin.');
        }

        // Selain itu, lanjutkan (admin, petugas, user terverifikasi)
        return $next($request);
    }
}
