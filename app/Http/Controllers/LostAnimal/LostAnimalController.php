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

    public function found($uuid)
    {
        $this->service->found($uuid);

        return $this->success('Animal encontrado com sucesso');
    }

    public function conclude($uuid)
    {
        $this->service->conclude($uuid);

        return $this->success('Concluído com sucesso');
    }
}
