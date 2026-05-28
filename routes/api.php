<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SecretController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rotas de Autenticação com limite rigoroso [1]
Route::middleware('throttle:login')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

// Rotas de Segredos com limite padrão de API [4, 5]
Route::middleware(['auth:sanctum', 'throttle:api'])->group(function () {
    Route::apiResource('secrets', SecretController::class);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/secrets', [SecretController::class, 'store']);

    Route::get('/secrets/{id}', [SecretController::class, 'show']);

});
