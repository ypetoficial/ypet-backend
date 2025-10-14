<?php

namespace App\Domains\MobileClinicEvent\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\MobileClinicEvent\Repositories\MobileClinicEventRepository;
use App\Events\MobileClinicEventCreated;

class MobileClinicEventService extends AbstractService
{
    public function __construct(MobileClinicEventRepository $repository)
    {
        $this->repository = $repository;
    }

    public function afterSave($entity, array $params)
    {
        event(new MobileClinicEventCreated($entity, $params));

        return $entity;
    }
}
