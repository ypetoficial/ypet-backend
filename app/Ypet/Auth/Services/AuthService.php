<?php

namespace App\Ypet\Auth\Services;

use App\Ypet\Abstracts\AbstractService;
use App\Ypet\Common\Enums\UserStatusEnum;
use App\Ypet\User\Services\UserService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class AuthService
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(array $data)
    {
        $user = $this->userService->findByEmail($data['email']);

        if (
            !$user ||
            !Hash::check($data['password'], $user->password) ||
            $user->status === UserStatusEnum::DISABLED->value ||
            $user->status === UserStatusEnum::SUSPENDED->value
        ) {
            throw ValidationException::withMessages([
                'email' => trans('exceptions.auth.failed'),
            ]);
        }

        $token = $user->createToken('auth-token')->plainTextToken;

        return $this->respondWithToken($token);
    }

    /**
     * Log the user out (Revoke the token).
     *
     * @return void
     */
    public function logout()
    {
        request()->user()->currentAccessToken()->delete();
    }

    /**
     * Send email Password Reset Link.
     *
     * @return void
     */
    public function forgetPassword(array $data)
    {
        Password::sendResetLink($data);
    }

    /**
     * Reset password user.
     */
    public function resetPassword(array $data)
    {
        $reset_password_status = Password::reset($data, function ($user, $password) {
            $this->userService->update($user->id, [
                'password' => $password,
            ]);
        });

        if ($reset_password_status == Password::INVALID_TOKEN) {
            throw ValidationException::withMessages([
                'token' => trans('auth.invalid'),
            ]);
        }
    }

    /**
     * Get the token array structure.
     */
    private function respondWithToken(string $token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
        ];
    }
}
