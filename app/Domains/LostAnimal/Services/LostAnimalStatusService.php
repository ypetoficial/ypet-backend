<?php

namespace App\Domains\LostAnimal\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\Enums\LostAnimalStatusEnum;
use App\Domains\LostAnimal\Repositories\LostAnimalStatusRepository;

class LostAnimalStatusService extends AbstractService
{
    public function __construct(LostAnimalStatusRepository $repository)
    {
        $this->repository = $repository;
    }

    public function updateStatus(int|string $id, LostAnimalStatusEnum $status)
    {
        return $this->repository->updateStatus($id, $status);
    }
}
