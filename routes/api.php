<?php

use App\Http\Controllers\Address\AddressController;
use App\Http\Controllers\AdoptionVisit\AdoptionVisitController;
use App\Http\Controllers\Animal\AnimalController;
use App\Http\Controllers\AnimalAmbulance\AnimalAmbulanceController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Citizen\CitizenController;
use App\Http\Controllers\EnumController;
use App\Http\Controllers\LostAnimal\LostAnimalController;
use App\Http\Controllers\MobileClinicEvent\MobileClinicEventController;
use App\Http\Controllers\PreSurgeryAssessment\PreSurgeryAssessmentController;
use App\Http\Controllers\Protector\ProtectorController;
use App\Http\Controllers\Registration\RegistrationController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\Veterinarian\VeterinarianController;
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
    Route::apiResource('veterinarians', VeterinarianController::class);
    Route::apiResource('animals', AnimalController::class);
    Route::apiResource('lost-animals', LostAnimalController::class);
    Route::apiResource('mobile-clinic-events', MobileClinicEventController::class);
    Route::apiResource('registrations', RegistrationController::class);
    Route::get('enums/{enum}', [EnumController::class, 'show']);
    Route::get('citizen', [CitizenController::class, 'index']);
    Route::get('citizen/{uuid}', [CitizenController::class, 'show']);
    Route::put('/citizen/{uuid}', [CitizenController::class, 'update']);

    Route::get('protector', [ProtectorController::class, 'index']);
    Route::get('protector/{uuid}', [ProtectorController::class, 'show']);
    Route::put('/protector/{uuid}', [ProtectorController::class, 'update']);

    Route::apiResource('animal-ambulance', AnimalAmbulanceController::class)->except('destroy');

    Route::prefix('adoption-visits')->group(function () {
        Route::get('/', [AdoptionVisitController::class, 'index']);
        Route::get('/{uuid}', [AdoptionVisitController::class, 'show']);
        Route::put('/{uuid}', [AdoptionVisitController::class, 'update']);
        Route::post('/{uuid}/confirm', [AdoptionVisitController::class, 'confirm']);
        Route::post('/{uuid}/reschedule', [AdoptionVisitController::class, 'reschedule']);
        Route::post('/{uuid}/complete', [AdoptionVisitController::class, 'complete']);
        Route::post('/{uuid}/cancel', [AdoptionVisitController::class, 'cancel']);
    });

    Route::apiResource('pre-surgery-assessment', PreSurgeryAssessmentController::class)->only('store');
});

Route::post('adoption-visits', [AdoptionVisitController::class, 'store']);
Route::post('protector', [ProtectorController::class, 'store']);
Route::post('citizen', [CitizenController::class, 'store']);
Route::get('busca/cep/{cep}', [AddressController::class, 'searchCep']);
