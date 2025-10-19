<?php

namespace App\Http\Controllers\Auth;

use App\Domains\Enums\UserStatusEnum;
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
        $login = $request->input('login');
        $password = $request->input('password');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'document';

        if (! Auth::attempt([$fieldType => $login, 'password' => $password])) {
            throw ValidationException::withMessages([
                'login' => ['As credenciais fornecidas estão incorretas.'],
            ]);
        }

        $user = User::where($fieldType, $login)->firstOrFail();
        $userstatus = UserStatus::where('user_id', $user?->id)->firstOrFail();

        if ($userstatus->status != UserStatusEnum::ACTIVE->value) {
            throw ValidationException::withMessages([
                'login' => ['Sua conta está inativa. Entre em contato com o administrador.'],
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
