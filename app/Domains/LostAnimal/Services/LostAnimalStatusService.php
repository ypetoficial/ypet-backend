<?php

namespace App\Domains\LostAnimal\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\LostAnimal\Repositories\LostAnimalStatusRepository;

class LostAnimalStatusService extends AbstractService
{
    public function __construct(LostAnimalStatusRepository $repository)
    {
        $this->repository = $repository;
    }
}
