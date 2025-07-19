<?php

namespace App\Domains\Animal\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\Animal\Repositories\AnimalRepository;

class AnimalService extends AbstractService
{
    public function __construct(AnimalRepository $repository)
    {
        $this->repository = $repository;
    }
}
