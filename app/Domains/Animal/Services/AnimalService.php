<?php

namespace App\Domains\Animal\Services;

use App\Domains\Animal\Repositories\AnimalRepository;
use App\Domains\Abstracts\AbstractService;

class AnimalService extends AbstractService
{
    public function __construct(AnimalRepository $repository)
    {
        $this->repository = $repository;
    }
}
