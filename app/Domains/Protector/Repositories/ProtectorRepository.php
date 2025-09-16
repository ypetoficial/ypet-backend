<?php

namespace App\Domains\Protector\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\Protector\Entities\ProtectorEntity;

class ProtectorRepository extends AbstractRepository
{
    public function __construct(ProtectorEntity $model)
    {
        $this->model = $model;
    }
}
