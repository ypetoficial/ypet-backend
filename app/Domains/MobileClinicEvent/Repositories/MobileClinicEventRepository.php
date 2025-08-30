<?php

namespace App\Domains\MobileClinicEvent\Repositories;

use App\Domains\MobileClinicEvent\Entities\MobileClinicEventEntity;
use App\Domains\Abstracts\AbstractRepository;

class MobileClinicEventRepository extends AbstractRepository
{
    public function __construct(MobileClinicEventEntity $model)
    {
        $this->model = $model;
    }
}
