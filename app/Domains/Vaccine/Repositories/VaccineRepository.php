<?php

namespace App\Domains\Vaccine\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\Vaccine\Entities\VaccineEntity;

class VaccineRepository extends AbstractRepository
{
    public function __construct(VaccineEntity $model)
    {
        $this->model = $model;
    }
}
