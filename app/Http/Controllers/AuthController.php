<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Ypet\Auth\Services\AuthService;
use App\Ypet\User\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Method __construct
     *
     * @return void
     */
    public function __construct(private AuthService $authService)
    {
    }

    /**
     * Logs in the user with the given credentials.
     *
     * @param  LoginRequest  $request
     * @return \Illuminate\Http\JsonResponse.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            return $this->ok($this->authService->login($request->validated()));
        } catch (ValidationException $e) {
            return $this->error($this->messageErrorDefault, $e->errors());
        }
    }

    /**
     * Get the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request): JsonResponse
    {
        return $this->ok($request->user()->toArray());
    }

    /**
     * Log the user out (Invalidate the token).
     */
    public function logout(Request $request): JsonResponse
    {
        $this->authService->logout();

        Auth::guard('web')->logout();

        return $this->success('Successfully logged out');
    }

    /**
     * Send email Password Reset Link.
     *
     * @param  ForgetPasswordRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgetPassword(ForgetPasswordRequest $request): JsonResponse
    {
        $this->authService->forgetPassword($request->validated());

        return $this->success('Reset password link sent on email.');
    }

    /**
     * Reset user password.
     *
     * @param  ResetPasswordRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        try {
            $this->authService->resetPassword($request->validated());

            return $this->success('Password has been successfully changed');
        } catch (ValidationException $e) {
            return $this->error($this->messageErrorDefault, $e->errors());
        }
    }
}
