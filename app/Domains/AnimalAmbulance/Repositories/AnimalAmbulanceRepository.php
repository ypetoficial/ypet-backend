<?php

namespace App\Domains\AnimalAmbulance\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\AnimalAmbulance\Entities\AnimalAmbulanceEntity;

class AnimalAmbulanceRepository extends AbstractRepository
{
    public function __construct(AnimalAmbulanceEntity $model)
    {
        $this->model = $model;
    }
}
