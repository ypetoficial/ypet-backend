<?php

namespace App\Http\Controllers\LostAnimal;

use App\Domains\LostAnimal\Services\LostAnimalService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\Animal\UpdateAnimalRequest;
use App\Http\Requests\LostAnimal\StoreLostAnimalRequest;

class LostAnimalController extends AbstractController
{
    protected $requestValidate = StoreLostAnimalRequest::class;

    protected $requestValidateUpdate = UpdateAnimalRequest::class;

    public function __construct(LostAnimalService $service)
    {
        $this->service = $service;
    }
}
