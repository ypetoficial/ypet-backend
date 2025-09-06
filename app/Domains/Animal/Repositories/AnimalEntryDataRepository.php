<?php

namespace App\Domains\Animal\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\Animal\Entities\AnimalEntryDataEntity;

class AnimalEntryDataRepository extends AbstractRepository
{
    public function __construct(AnimalEntryDataEntity $model)
    {
        $this->model = $model;
    }
}
