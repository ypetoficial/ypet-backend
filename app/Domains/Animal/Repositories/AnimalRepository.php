<?php

namespace App\Domains\Animal\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\Animal\Entities\AnimalEntity;

class AnimalRepository extends AbstractRepository
{
    public function __construct(AnimalEntity $model)
    {
        $this->model = $model;
    }
}
