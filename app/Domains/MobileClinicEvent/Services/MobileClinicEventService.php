<?php

namespace App\Domains\MobileClinicEvent\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\MobileClinicEvent\Repositories\MobileClinicEventRepository;

class MobileClinicEventService extends AbstractService
{
    public function __construct(MobileClinicEventRepository $repository)
    {
        $this->repository = $repository;
    }
}
