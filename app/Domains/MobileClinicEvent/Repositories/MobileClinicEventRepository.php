<?php

namespace App\Domains\MobileClinicEvent\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\MobileClinicEvent\Entities\MobileClinicEventEntity;

class MobileClinicEventRepository extends AbstractRepository
{
    public function __construct(MobileClinicEventEntity $model)
    {
        $this->model = $model;
    }
}
