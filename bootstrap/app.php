<?php

use App\Http\Middleware\ForceJsonResponse;
use App\Http\Middleware\HandleSanctumErrors;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Exceptions\MissingAbilityException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        api: __DIR__.'/../routes/api.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api(append: [
            ForceJsonResponse::class,
        ]);
        
        $middleware->alias([
            'json.response' => ForceJsonResponse::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (\Throwable $e, Request $request) {
            if ($request->is('api/*') || $request->expectsJson()) {
                // Menangani semua error autentikasi dan token Sanctum
                if ($e instanceof AuthenticationException || 
                    $e instanceof UnauthorizedHttpException ||
                    ($e instanceof \Exception && str_contains($e->getMessage(), 'token')) ||
                    ($e instanceof \Exception && str_contains($e->getMessage(), 'unauthenticated')) ||
                    ($request->headers->has('Authorization') && !Auth::check())
                ) {
                    return response()->json([
                        'message' => 'Autentikasi gagal',
                        'error' => 'Token tidak valid atau tidak ditemukan'
                    ], 401);
                }
                
                // Menangani error izin akses
                if ($e instanceof MissingAbilityException) {
                    return response()->json([
                        'message' => 'Akses ditolak',
                        'error' => 'Anda tidak memiliki izin untuk mengakses resource ini'
                    ], 403);
                }
                
                // Menangani semua kesalahan server lainnya
                if (!app()->environment('production')) {
                    return response()->json([
                        'message' => 'Server error',
                        'error' => $e->getMessage(),
                        'file' => $e->getFile(),
                        'line' => $e->getLine(),
                        'trace' => $e->getTrace()
                    ], 500);
                }
                
                return response()->json([
                    'message' => 'Server error',
                    'error' => 'Terjadi kesalahan pada server'
                ], 500);
            }
        });
    })->create();
