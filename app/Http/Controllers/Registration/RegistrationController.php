<?php

namespace App\Http\Controllers\Registration;

use App\Http\Controllers\AbstractController;
use App\Domains\Registration\Services\RegistrationService;


class RegistrationController extends AbstractController
{
    public function __construct(RegistrationService $service)
    {
        $this->service = $service;
    }
}
