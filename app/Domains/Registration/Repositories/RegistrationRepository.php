<?php

namespace App\Domains\Registration\Repositories;

use App\Domains\Registration\Entities\RegistrationEntity;
use App\Domains\Abstracts\AbstractRepository;

class RegistrationRepository extends AbstractRepository
{
    public function __construct(RegistrationEntity $model)
    {
        $this->model = $model;
    }
}
