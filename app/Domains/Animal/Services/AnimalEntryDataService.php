<?php

namespace App\Domains\Animal\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\Animal\Repositories\AnimalEntryDataRepository;

class AnimalEntryDataService extends AbstractService
{
    public function __construct(AnimalEntryDataRepository $repository)
    {
        $this->repository = $repository;
    }
}
