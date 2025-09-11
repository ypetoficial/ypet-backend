<?php

namespace App\Http\Controllers\Citizen;

use App\Domains\Citizen\Services\CitizenService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\Citizen\StoreCitizenRequest;
use App\Http\Requests\Citizen\UpdateCitizenRequest;

class CitizenController extends AbstractController
{
    public $requestValidate = StoreCitizenRequest::class;

    public $requestValidateUpdate = UpdateCitizenRequest::class;

    public function __construct(CitizenService $service)
    {
        $this->service = $service;
    }
}
