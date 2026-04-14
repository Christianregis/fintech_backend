<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Fonction pour se connecter
     *
     * @param UserRegisterRequest $request
     * @return void
     */
    public function register(UserRegisterRequest $request)
    {
        $request->validated();
        $user = User::create($request->validated());
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            "message" => "Inscription reussie !",
            'user' => UserResource::make($user),
            'token' => $token,
        ],201);
    }

    /**
     * Fonction pour se connecter
     *
     * @param LoginRequest $request
     * @return void
     */
    public function login(LoginRequest $request)
    {
        $request->validated();
        if (Auth::attempt($request->validated())) {
            $user = Auth::user();
            $token = $user->createToken("auth_token")->plainTextToken;
            return response()->json([
                'user' => UserResource::make($user),
                'token' => $token,
                'message' => "Connexion reussie"
            ], 200);
        }

        return response()->json([
            'message' => "Email ou mot de passe incorrect"
        ], 401);
    }

    /**
     * Fonction pour afficher les informations d'un utilisateur connecte via Sanctum
     *
     * @return void
     */
    public function me()
    {
        $user = Auth::user();
        return response()->json([
            'user' => UserResource::make($user)
        ]);
    }

    public function logout()
    {
        $user = Auth::user();
        $user->tokens()->delete();

        return response()->json([
            'message' => "Déconnexion réussie"
        ], 200);
    }
}
