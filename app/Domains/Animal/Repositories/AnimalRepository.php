<?php

namespace App\Domains\Animal\Repositories;

use App\Domains\Animal\Entities\AnimalEntity;
use App\Domains\Abstracts\AbstractRepository;

class AnimalRepository extends AbstractRepository
{
    public function __construct(AnimalEntity $model)
    {
        $this->model = $model;
    }
}
