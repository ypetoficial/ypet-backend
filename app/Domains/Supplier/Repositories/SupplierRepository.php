<?php

namespace App\Domains\Supplier\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\Supplier\Entities\SupplierEntity;

class SupplierRepository extends AbstractRepository
{
    public function __construct(SupplierEntity $model)
    {
        $this->model = $model;
    }
}
