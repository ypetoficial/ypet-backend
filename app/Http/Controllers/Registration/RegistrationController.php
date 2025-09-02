<?php

namespace App\Http\Controllers\Registration;

use App\Http\Controllers\AbstractController;
use App\Domains\Registration\Services\RegistrationService;
use App\Http\Requests\Registration\RegistrationRequest;

class RegistrationController extends AbstractController
{
    protected $requestValidate = RegistrationRequest::class;

    public function __construct(RegistrationService $service)
    {
        $this->service = $service;
    }
}
