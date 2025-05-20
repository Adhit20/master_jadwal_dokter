<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ScheduleController;
use App\Http\Middleware\ForceJsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Terapkan middleware ForceJsonResponse ke semua route API
Route::middleware([ForceJsonResponse::class])->group(function () {
    // Public routes (tidak perlu autentikasi)
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/users', [AuthController::class, 'getAllUsers']);

    // Custom error handler untuk token invalid
    Route::any('/unauthorized', function() {
        return response()->json([
            'message' => 'Autentikasi gagal',
            'error' => 'Token tidak valid atau tidak ditemukan'
        ], 401);
    })->name('unauthorized');

    // Protected routes (perlu autentikasi)
    Route::middleware('auth:sanctum')->group(function () {
        // User routes
        Route::get('/user', [AuthController::class, 'user']);
        Route::post('/logout', [AuthController::class, 'logout']);
        
        // Routes untuk jadwal dokter
        Route::get('/schedules', [ScheduleController::class, 'index']);
        Route::post('/schedules', [ScheduleController::class, 'store']);
        
        // Routes untuk dokter
        Route::apiResource('doctors', DoctorController::class);
    });
}); 