<?php

namespace App\Domains\Citizen\Repositories;

use App\Domains\Citizen\Entities\CitizenEntity;
use App\Domains\Abstracts\AbstractRepository;

class CitizenRepository extends AbstractRepository
{
    public function __construct(CitizenEntity $model)
    {
        $this->model = $model;
    }
}
