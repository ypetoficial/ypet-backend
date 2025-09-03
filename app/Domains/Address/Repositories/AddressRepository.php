<?php

namespace App\Domains\Address\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\Address\Entities\AddressEntity;

class AddressRepository extends AbstractRepository
{
    public function __construct(AddressEntity $model)
    {
        $this->model = $model;
    }
}
