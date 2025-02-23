<?php

use App\Http\Middleware\JwtMiddleware;
use App\Http\Controllers\V1\Finance\WalletsController;
use App\Http\Controllers\V1\Finance\TransactionsController;

Route::prefix('finance')
    ->middleware(JwtMiddleware::class)
    ->group(function () {
        Route::get('wallets/all', [WalletsController::class, 'allByUser']);
        Route::get('wallets/{id}/balance-history', [WalletsController::class, 'balanceHistory']);
        Route::apiResource('wallets', WalletsController::class)
            ->only('store', 'update', 'show', 'destroy');

        Route::get('transactions/all', [TransactionsController::class, 'allByUser']);
        Route::get('transactions/wallet/{id}', [TransactionsController::class, 'allByWallet']);
        Route::post('transactions/deposit', [TransactionsController::class, 'deposit']);
        Route::post('transactions/withdraw', [TransactionsController::class, 'withdraw']);
        Route::apiResource('transactions', TransactionsController::class)
            ->only('store', 'update', 'show', 'destroy');
    });
