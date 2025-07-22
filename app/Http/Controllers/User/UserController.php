<?php

namespace App\Http\Controllers\User;

use App\Domains\User\Services\UserService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends AbstractController
{
    public $requestValidate = StoreUserRequest::class;

    public $requestValidateUpdate = UpdateUserRequest::class;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
}
