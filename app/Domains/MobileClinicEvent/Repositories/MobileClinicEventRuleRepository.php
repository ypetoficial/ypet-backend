<?php

namespace App\Domains\MobileClinicEvent\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\MobileClinicEvent\Entities\MobileClinicEventRuleEntity;

class MobileClinicEventRuleRepository extends AbstractRepository
{
    public function __construct(MobileClinicEventRuleEntity $model)
    {
        $this->model = $model;
    }
}
