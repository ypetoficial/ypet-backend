<?php

namespace App\Ypet\User\Repositories;

use App\Models\User;
use App\Ypet\Abstracts\AbstractRepository;

class UserRepository extends AbstractRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function findByEmail(string $email): ?User
    {
        return $this->findOneWhere(['email' => $email]);
    }
}
