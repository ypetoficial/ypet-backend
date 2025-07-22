<?php

namespace App\Domains\User\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\User\Entities\UserStatusEntity;

class UserStatusRepository extends AbstractRepository
{
    public function __construct(UserStatusEntity $model)
    {
        $this->model = $model;
    }
}
