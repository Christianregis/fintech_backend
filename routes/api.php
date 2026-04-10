<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::group(['prefix' => 'v1'], function () {

    // Route pour s'isncire
    Route::post('/register', [UserController::class, 'register']);
    // Route pour se connecter
    Route::post('/login', [UserController::class, 'login']);
});
