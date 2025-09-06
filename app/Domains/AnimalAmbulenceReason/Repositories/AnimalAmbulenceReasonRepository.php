<?php

namespace App\Domains\AnimalAmbulenceReason\Repositories;

use App\Domains\AnimalAmbulenceReason\Entities\AnimalAmbulenceReasonEntity;
use App\Domains\Abstracts\AbstractRepository;

class AnimalAmbulenceReasonRepository extends AbstractRepository
{
    public function __construct(AnimalAmbulenceReasonEntity $model)
    {
        $this->model = $model;
    }
}
