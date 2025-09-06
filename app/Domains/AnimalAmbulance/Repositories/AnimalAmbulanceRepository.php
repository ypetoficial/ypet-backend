<?php

namespace App\Domains\AnimalAmbulance\Repositories;

use App\Domains\AnimalAmbulance\Entities\AnimalAmbulanceEntity;
use App\Domains\Abstracts\AbstractRepository;

class AnimalAmbulanceRepository extends AbstractRepository
{
    public function __construct(AnimalAmbulanceEntity $model)
    {
        $this->model = $model;
    }
}
