<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    require base_path('routes/schemas/api-auth.php');

    require base_path('routes/schemas/api-wallet.php');
});
