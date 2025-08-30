<?php

namespace App\Domains\Address\Repositories;

use App\Domains\Address\Entities\AddressEntity;
use App\Domains\Abstracts\AbstractRepository;

class AddressRepository extends AbstractRepository
{
    public function __construct(AddressEntity $model)
    {
        $this->model = $model;
    }
}
