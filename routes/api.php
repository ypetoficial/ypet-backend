<?php

use App\Http\Controllers\Animal\AnimalController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\EnumController;
use App\Http\Controllers\MobileClinicEvent\MobileClinicEventController;
use App\Http\Controllers\Registration\RegistrationController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserProfileController;
use Illuminate\Support\Facades\Route;

// Public authentication routes
Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', [RegisterController::class, 'register']);
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('/reset-password', [ResetPasswordController::class, 'reset']);
});

// Protected authentication routes
Route::middleware('auth:sanctum')->group(function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/logout', [LogoutController::class, 'logout']);
        Route::post('/logout-all', [LogoutController::class, 'logoutAll']);
        Route::get('/me', [UserProfileController::class, 'me']);
        Route::put('/me/profile', [UserProfileController::class, 'updateProfile']);
        Route::put('/me/password', [UserProfileController::class, 'changePassword']);
    });

    Route::apiResource('users', UserController::class);
    Route::apiResource('animals', AnimalController::class);
    Route::apiResource('mobile-clinic-events', MobileClinicEventController::class);
    Route::apiResource('registrations', RegistrationController::class);
    Route::get('enums/{enum}', [EnumController::class, 'show']);
});

Route::middleware(['auth:sanctum', 'role:ADMIN'])->group(function () {
    Route::apiResource('users', UserController::class);
});
