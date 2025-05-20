<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleSanctumErrors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
        return $next($request);
        } catch (AuthenticationException $e) {
            return response()->json([
                'message' => 'Autentikasi gagal',
                'error' => 'Token tidak valid atau tidak ditemukan'
            ], 401);
        }
    }
}
