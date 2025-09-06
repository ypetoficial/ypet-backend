<?php

namespace App\Domains\LostAnimal\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\LostAnimal\Repositories\LostAnimalRepository;

class LostAnimalService extends AbstractService
{
    public function __construct(LostAnimalRepository $repository)
    {
        $this->repository = $repository;
    }
}
