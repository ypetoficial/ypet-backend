<?php

namespace App\Http\Controllers\User;

use App\Domains\User\Services\UserService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserController extends AbstractController
{
    public $requestValidate = StoreUserRequest::class;

    public $requestValidateUpdate = UpdateUserRequest::class;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function panelConfig()
    {
        $user = $this->validateUserLogged();

        return $this->service->panelConfig($user);
    }

    public function changePasswordPanel(ChangePasswordRequest $request)
    {
        $this->validateUserLogged();

        $userProfileController = app(UserProfileController::class);
        $changePassword = $userProfileController->changePassword($request);

        return $changePassword;
    }

    protected function validateUserLogged()
    {
        $user = Auth::user();

        if ($user->hasExactRoles('user_common')) {
            Log::warning("Acesso negado para o usuário ID {$user->id}");
            throw new HttpException(403, 'Acesso negado. Permissão não autorizada.');
        }

        return $user;
    }
}
