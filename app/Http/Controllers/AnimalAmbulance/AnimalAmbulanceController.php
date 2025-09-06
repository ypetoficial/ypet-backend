<?php

namespace App\Http\Controllers\AnimalAmbulance;

use App\Domains\AnimalAmbulance\Services\AnimalAmbulanceService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\AnimalAmbulence\StoreAnimalAmbulenceRequest;
use App\Http\Requests\AnimalAmbulence\UpdateAnimalAmbulenceRequest;

class AnimalAmbulanceController extends AbstractController
{
    protected $requestValidate = StoreAnimalAmbulenceRequest::class;

    protected $updateRequestValidate = UpdateAnimalAmbulenceRequest::class;

    public function __construct(AnimalAmbulanceService $service)
    {
        $this->service = $service;
    }
}
