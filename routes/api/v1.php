<?php

use App\Http\Controllers\API\V1\UsersController;
use Illuminate\Support\Facades\Route;


Route::prefix('api/v1')->group(function () {
    Route::prefix('users')->group(function () {
        Route::post(
            '',
            [UsersController::class, 'store']
        );
        Route::get(
            '',
            [UsersController::class, 'store']
        );
    });
});
