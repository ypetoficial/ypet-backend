<?php

namespace App\Domains\Citizen\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\Citizen\Entities\CitizenEntity;

class CitizenRepository extends AbstractRepository
{
    public function __construct(CitizenEntity $model)
    {
        $this->model = $model;
    }
}
