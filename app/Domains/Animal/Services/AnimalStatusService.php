<?php

namespace App\Domains\Animal\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\Animal\Repositories\AnimalStatusRepository;

class AnimalStatusService extends AbstractService
{
    public function __construct(AnimalStatusRepository $repository)
    {
        $this->repository = $repository;
    }
}
