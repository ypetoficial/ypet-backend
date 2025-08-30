<?php

namespace App\Domains\MobileClinicEvent\Services;

use App\Domains\MobileClinicEvent\Repositories\MobileClinicEventRepository;
use App\Domains\Abstracts\AbstractService;

class MobileClinicEventService extends AbstractService
{
    public function __construct(MobileClinicEventRepository $repository)
    {
        $this->repository = $repository;
    }
}
