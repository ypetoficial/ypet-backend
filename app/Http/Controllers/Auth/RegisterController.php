<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $clientType = $request->header('X-Client-Type', 'spa');
        $tokenName = $clientType === 'mobile' ? 'mobile_token' : 'spa_token';
        $expiresAt = now()->addMinutes(config('sanctum.expiration', 60));
        $token = $user->createToken($tokenName, ['*'], $expiresAt);

        return response()->json([
            'message' => 'Registro realizado com sucesso.',
            'user' => $user,
            'access_token' => $token->plainTextToken,
            'token_type' => 'Bearer',
            'expires_in' => $token->accessToken->expires_at->timestamp,
        ], Response::HTTP_CREATED);
    }
}
