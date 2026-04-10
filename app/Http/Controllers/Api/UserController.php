<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

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
        $request->validate();
        $user = User::create($request);
        $token = $user->createPlainTextToken();

        return response()->json([
            'user' => UserResource::make($user),
            'token' => $token,
        ]);
    }
}
