<?php

namespace App\Domains\Animal\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\Animal\Entities\AnimalStatusEntity;

class AnimalStatusRepository extends AbstractRepository
{
    public function __construct(AnimalStatusEntity $model)
    {
        $this->model = $model;
    }
}
