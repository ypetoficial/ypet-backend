<?php

namespace App\Domains\Animal\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\Animal\Repositories\AnimalRepository;
use App\Events\AnimalCreated;

class AnimalService extends AbstractService
{
    public function __construct(AnimalRepository $repository)
    {
        $this->repository = $repository;
    }

    public function afterSave($entity, array $params)
    {
        event(new AnimalCreated($entity, $params));

        return $entity;
    }
}
