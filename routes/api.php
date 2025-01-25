<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\V1\AuthController;


Route::prefix('v1')->group(function () {
    require base_path('routes/schemas/api-auth.php');
});
