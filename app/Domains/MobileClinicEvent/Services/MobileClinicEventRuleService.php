<?php

namespace App\Domains\MobileClinicEvent\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\MobileClinicEvent\Repositories\MobileClinicEventRuleRepository;

class MobileClinicEventRuleService extends AbstractService
{
    public function __construct(MobileClinicEventRuleRepository $repository)
    {
        $this->repository = $repository;
    }
}
