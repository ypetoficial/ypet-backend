<?php

namespace App\Domains\Application\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\Application\Entities\ApplicationEntity;

class ApplicationRepository extends AbstractRepository
{
    public function __construct(ApplicationEntity $model)
    {
        $this->model = $model;
    }
}
