<?php

namespace App\Http\Controllers\Animal;

use App\Domains\Animal\Services\AnimalService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\Animal\StoreAnimalRequest;
use App\Http\Requests\Animal\UpdateAnimalRequest;

class AnimalController extends AbstractController
{
    public $requestValidate = StoreAnimalRequest::class;

    public $requestValidateUpdate = UpdateAnimalRequest::class;

    public function __construct(AnimalService $service)
    {
        $this->service = $service;
    }
}
