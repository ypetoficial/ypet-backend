<?php

namespace App\Domains\LostAnimal\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\LostAnimal\Entities\LostAnimalStatusEntity;

class LostAnimalStatusRepository extends AbstractRepository
{
    public function __construct(LostAnimalStatusEntity $model)
    {
        $this->model = $model;
    }
}
