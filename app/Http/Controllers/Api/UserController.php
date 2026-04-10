<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
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
            'user' => UserResource::make($user),
            'token' => $token,
        ]);
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
        if(Auth::attempt($request->validated())){
            $user = Auth::user();
            $token = $user->createToken("auth_token")->plainTextToken;
            return response()->json([
                'user' => UserResource::make($user),
                'token' => $token,
            ], 200);
        }

        return response()->json([
            'message' => "Email ou mot de passe incorrect"
        ], 401);
    }
}
