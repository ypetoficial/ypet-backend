<?php

use App\Http\Controllers\Address\AddressController;
use App\Http\Controllers\AdoptionVisit\AdoptionVisitController;
use App\Http\Controllers\Animal\AnimalController;
use App\Http\Controllers\AnimalAmbulance\AnimalAmbulanceController;
use App\Http\Controllers\AnimalEvaluationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\BankAccount\BankAccountController;
use App\Http\Controllers\Citizen\CitizenController;
use App\Http\Controllers\Collaborator\CollaboratorController;
use App\Http\Controllers\EnumController;
use App\Http\Controllers\Location\LocationController;
use App\Http\Controllers\LostAnimal\LostAnimalController;
use App\Http\Controllers\MobileClinicEvent\MobileClinicEventController;
use App\Http\Controllers\Notification\NotificationController;
use App\Http\Controllers\PreSurgeryAssessment\PreSurgeryAssessmentController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Protector\ProtectorController;
use App\Http\Controllers\Registration\RegistrationController;
use App\Http\Controllers\Report\ReportController;
use App\Http\Controllers\Supplier\SupplierController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\Vaccine\VaccineController; // added
use App\Http\Controllers\Veterinarian\VeterinarianController;
use Illuminate\Support\Facades\Route;

// Public authentication routes
Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', [RegisterController::class, 'register']);
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('/validate-reset-token', [ResetPasswordController::class, 'validateToken']);
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
        Route::post('/me/firebase-token', [UserProfileController::class, 'updateFirebaseToken']);
    });

    Route::get('panel-config', [UserController::class, 'panelConfig']);
    Route::put('panel-config', [UserController::class, 'changePasswordPanel']);

    Route::apiResource('users', UserController::class);
    Route::apiResource('veterinarians', VeterinarianController::class);
    Route::apiResource('animals', AnimalController::class);
    Route::prefix('lost-animals')->group(function () {
        Route::apiResource('', LostAnimalController::class);
        Route::post('{uuid}/found', [LostAnimalController::class, 'found']);
        Route::post('{uuid}/conclude', [LostAnimalController::class, 'conclude']);
    });
    Route::apiResource('mobile-clinic-events', MobileClinicEventController::class);
    Route::apiResource('registrations', RegistrationController::class);
    Route::apiResource('suppliers', SupplierController::class);
    Route::get('registrations/{id}/term', [RegistrationController::class, 'term']);
    Route::get('enums/{enum}', [EnumController::class, 'show']);
    Route::get('citizen', [CitizenController::class, 'index']);
    Route::get('citizen/{uuid}', [CitizenController::class, 'show']);
    Route::put('/citizen/{uuid}', [CitizenController::class, 'update']);

    Route::get('protector', [ProtectorController::class, 'index']);
    Route::get('protector/{uuid}', [ProtectorController::class, 'show']);
    Route::put('/protector/{uuid}', [ProtectorController::class, 'update']);
    Route::apiResource('vaccine', VaccineController::class);
    Route::get('vaccine/alert', [VaccineController::class, 'vaccineAlert']);

    Route::apiResource('animal-ambulance', AnimalAmbulanceController::class)->except('destroy');

    // products routes
    Route::apiResource('products', ProductController::class);
    Route::get('products/{id}/supply', [ProductController::class, 'supply']);

    Route::prefix('adoption-visits')->group(function () {
        Route::get('/', [AdoptionVisitController::class, 'index']);
        Route::get('/{uuid}', [AdoptionVisitController::class, 'show']);
        Route::put('/{uuid}', [AdoptionVisitController::class, 'update']);
        Route::post('/{uuid}/confirm', [AdoptionVisitController::class, 'confirm']);
        Route::post('/{uuid}/reschedule', [AdoptionVisitController::class, 'reschedule']);
        Route::post('/{uuid}/complete', [AdoptionVisitController::class, 'complete']);
        Route::post('/{uuid}/cancel', [AdoptionVisitController::class, 'cancel']);
    });

    Route::prefix('evaluation-animal')->group(function () {
        Route::get('/', [AnimalEvaluationController::class, 'index']);
        Route::post('/{uuid}/approved', [AnimalEvaluationController::class, 'approved']);
        Route::post('/{uuid}/refused', [AnimalEvaluationController::class, 'refused']);
    });

    Route::prefix('reports')->group(function () {
        Route::post('/{uuid}/receive', [ReportController::class, 'received']);
        Route::post('/{uuid}/forward', [ReportController::class, 'forward']);
        Route::post('/{uuid}/complete', [ReportController::class, 'complete']);
        Route::post('/{uuid}/archive', [ReportController::class, 'archive']);
    });

    Route::apiResource('report', ReportController::class)->except('destroy');
    Route::apiResource('location', LocationController::class);
    Route::apiResource('pre-surgery-assessment', PreSurgeryAssessmentController::class)->only('store');
    Route::apiResource('pre-surgery-assessment', PreSurgeryAssessmentController::class)
        ->only('store');
    Route::apiResource('collaborators', CollaboratorController::class)
        ->only('index', 'show', 'store', 'update');
    Route::apiResource('bank-accounts', BankAccountController::class)
        ->only('index', 'show', 'update');

    // Rotas de notificações
    Route::prefix('notifications')->group(function () {
        Route::get('/', [NotificationController::class, 'index']);
        Route::get('/unread-count', [NotificationController::class, 'unreadCount']);
        Route::patch('/{id}/read', [NotificationController::class, 'markAsRead']);
        Route::patch('/mark-all-read', [NotificationController::class, 'markAllAsRead']);
        Route::post('/test-push', [NotificationController::class, 'testPush']);
    });
});

Route::post('adoption-visits', [AdoptionVisitController::class, 'store']);
Route::post('protector', [ProtectorController::class, 'store']);
Route::post('citizen', [CitizenController::class, 'store']);
Route::get('busca/cep/{cep}', [AddressController::class, 'searchCep']);
