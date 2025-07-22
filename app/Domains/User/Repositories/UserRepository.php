<?php

namespace App\Domains\User\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\User\Entities\UserEntity;

class UserRepository extends AbstractRepository
{
    public function __construct(UserEntity $entity)
    {
        $this->model = $entity;
    }
}
