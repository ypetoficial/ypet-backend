<?php

namespace App\Http\Controllers;

use App\Domains\EvaluationAnimal\Services\EvaluationAnimalStatusService;
use Illuminate\Http\Request;

class AnimalEvaluationController extends AbstractController
{
    public function __construct(EvaluationAnimalStatusService $service)
    {
        $this->service = $service;
    }

    public function approved($uuid)
    {
        $this->service->approved($uuid);

        return $this->success('Animal aprovado com sucesso');
    }

    public function refused($uuid)
    {
        $this->service->refused($uuid);

        return $this->success('Animal reprovado com sucesso');
    }
}
