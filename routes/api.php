<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnumController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Animal\AnimalController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Address\AddressController;
use App\Http\Controllers\Citizen\CitizenController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Protector\ProtectorController;

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
    Route::get('enums/{enum}', [EnumController::class, 'show']);
    Route::get('citizen', [CitizenController::class, 'index']);
    Route::get('citizen/{uuid}', [CitizenController::class, 'show']);
    Route::put('/citizen/{uuid}', [CitizenController::class, 'update']);

    Route::get('protector', [ProtectorController::class, 'index']);
    Route::get('protector/{uuid}', [ProtectorController::class, 'show']);
    Route::put('/protector/{uuid}', [ProtectorController::class, 'update']);
    
});

Route::post('protector', [ProtectorController::class, 'store']);
Route::post('citizen', [CitizenController::class, 'store']);
Route::get('busca/cep/{cep}', [AddressController::class, 'searchCep']);
