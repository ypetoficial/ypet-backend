<?php

namespace App\Domains\User\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\User\Repositories\UserRepository;
use App\Events\UserCreated;

class UserService extends AbstractService
{
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function afterSave($entity, array $params)
    {
        event(new UserCreated($entity, $params));

        return $entity;
    }
}
