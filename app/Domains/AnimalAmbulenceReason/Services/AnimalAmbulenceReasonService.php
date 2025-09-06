<?php

namespace App\Domains\AnimalAmbulenceReason\Services;

use App\Domains\AnimalAmbulenceReason\Repositories\AnimalAmbulenceReasonRepository;
use App\Domains\Abstracts\AbstractService;

class AnimalAmbulenceReasonService extends AbstractService
{
    public function __construct(AnimalAmbulenceReasonRepository $repository)
    {
        $this->repository = $repository;
    }
}
