<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TransactionController;

Route::group(['prefix' => 'v1'], function () {

    // Route pour s'isncire
    Route::post('/register', [UserController::class, 'register']);
    // Route pour se connecter
    Route::post('/login', [UserController::class, 'login']);
    // Route pour afficher les informations d'un utilisateur
    Route::get('/me', [UserController::class, 'me'])->middleware("auth:sanctum");


    // Route pour envoyer de l'argent
    Route::post('/transactions/send', [TransactionController::class, 'send'])->middleware("auth:sanctum");
    // Route pour afficher l'historique des transactions
    Route::get('/transactions/history', [TransactionController::class, 'history'])->middleware("auth:sanctum");

    // Route pour recharger son compte
    Route::post("/transactions/add", [TransactionController::class, 'add'])->middleware("auth:sanctum");
});
