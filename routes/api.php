<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::group(['prefix' => 'v1'], function () {

    // Route pour s'isncire
    Route::post('/register', [UserController::class, 'register']);
    // Route pour se connecter
    Route::post('/login', [UserController::class, 'login']);
    // Route pour afficher les informations d'un utilisateur
    Route::get('/me', [UserController::class, 'me'])->middleware("auth:sanctum");
});
