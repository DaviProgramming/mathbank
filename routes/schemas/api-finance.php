<?php

use App\Http\Middleware\JwtMiddleware;
use App\Http\Controllers\V1\Finance\WalletsController;

Route::prefix('finance')
    ->middleware(JwtMiddleware::class)
    ->group(function () {
        Route::get('wallets/all', [WalletsController::class, 'allByUser']);

        Route::apiResource('wallets', WalletsController::class)->only('store', 'update', 'show', 'destroy');
    });
