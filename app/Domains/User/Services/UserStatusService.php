<?php

namespace App\Domains\User\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\User\Repositories\UserStatusRepository;

class UserStatusService extends AbstractService
{
    public function __construct(UserStatusRepository $repository)
    {
        $this->repository = $repository;
    }
}
