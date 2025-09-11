<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Models\UserStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (! Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $userstatus = UserStatus::where('user_id', $user?->id)->firstOrFail();

        if ($userstatus->status != UserStatusEnum::ACTIVE->value) {
            throw ValidationException::withMessages([
                'email' => ['Sua conta está inativa. Entre em contato com o administrador.'],
            ]);
        }

        $clientType = $request->header('X-Client-Type', 'spa');
        $tokenName = $clientType === 'mobile' ? 'mobile_token' : 'spa_token';
        $expiresAt = now()->addMinutes(config('sanctum.expiration', 60));
        $token = $user->createToken($tokenName, ['*'], $expiresAt);

        return $this->ok([
            'message' => 'Login realizado com sucesso.',
            'user' => $user,
            'access_token' => $token->plainTextToken,
            'token_type' => 'Bearer',
            'expires_in' => $token->accessToken->expires_at->timestamp,
        ]);
    }
}
