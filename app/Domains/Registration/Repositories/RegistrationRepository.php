<?php

namespace App\Domains\Registration\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\Registration\Entities\RegistrationEntity;

class RegistrationRepository extends AbstractRepository
{
    public function __construct(RegistrationEntity $model)
    {
        $this->model = $model;
    }
}
