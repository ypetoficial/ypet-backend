<?php

namespace App\Domains\Protector\Repositories;

use App\Domains\Protector\Entities\ProtectorEntity;
use App\Domains\Abstracts\AbstractRepository;

class ProtectorRepository extends AbstractRepository
{
    public function __construct(ProtectorEntity $model)
    {
        $this->model = $model;
    }
}
