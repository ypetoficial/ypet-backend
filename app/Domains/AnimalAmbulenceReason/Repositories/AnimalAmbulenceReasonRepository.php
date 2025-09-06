<?php

namespace App\Domains\AnimalAmbulenceReason\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\AnimalAmbulenceReason\Entities\AnimalAmbulenceReasonEntity;

class AnimalAmbulenceReasonRepository extends AbstractRepository
{
    public function __construct(AnimalAmbulenceReasonEntity $model)
    {
        $this->model = $model;
    }
}
