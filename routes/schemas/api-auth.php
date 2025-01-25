<?php

use App\Http\Controllers\V1\AuthController;
use App\Http\Middleware\JwtMiddleware;

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);

    Route::post('register', [AuthController::class, 'register']);

    Route::post('refresh-token', [AuthController::class, 'refreshToken'])->middleware(JwtMiddleware::class);
});
