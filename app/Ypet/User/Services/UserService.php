<?php

namespace App\Ypet\User\Services;

use App\Ypet\Abstracts\AbstractService;
use App\Ypet\User\Repositories\UserRepository;

class UserService extends AbstractService
{
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findByEmail(string $email)
    {
        return $this->repository->findByEmail($email);
    }
}
