<?php

namespace App\Domains\Location\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\Location\Entities\LocationEntity;

class LocationRepository extends AbstractRepository
{
    public function __construct(LocationEntity $model)
    {
        $this->model = $model;
    }
}
