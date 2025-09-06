<?php

namespace App\Domains\AnimalAmbulenceReason\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\AnimalAmbulenceReason\Repositories\AnimalAmbulenceReasonRepository;

class AnimalAmbulenceReasonService extends AbstractService
{
    public function __construct(AnimalAmbulenceReasonRepository $repository)
    {
        $this->repository = $repository;
    }
}
