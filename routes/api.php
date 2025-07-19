<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Animal\AnimalController;

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
        Route::get('/me', [UserController::class, 'me']);
        Route::put('/me/profile', [UserController::class, 'updateProfile']);
        Route::put('/me/password', [UserController::class, 'changePassword']);
    });

    Route::apiResource('animals', AnimalController::class);
});
