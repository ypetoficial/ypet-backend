<?php

namespace App\Domains\LostAnimal\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\LostAnimal\Entities\LostAnimalEntity;

class LostAnimalRepository extends AbstractRepository
{
    public function __construct(LostAnimalEntity $model)
    {
        $this->model = $model;
    }
}
