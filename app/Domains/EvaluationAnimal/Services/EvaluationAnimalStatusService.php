<?php

namespace App\Domains\EvaluationAnimal\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\Enums\EvaluationAnimalStatusEnum;
use App\Domains\EvaluationAnimal\Repositories\EvaluationAnimalStatusRepository;

class EvaluationAnimalStatusService extends AbstractService
{
    public function __construct(EvaluationAnimalStatusRepository $repository)
    {
        $this->repository = $repository;
    }

    public function approved($id)
    {
        return $this->repository->updateStatus($id, EvaluationAnimalStatusEnum::APPROVED);
    }

    public function refused($id)
    {
        return $this->repository->updateStatus($id, EvaluationAnimalStatusEnum::REFUSED);
    }
}
