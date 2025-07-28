<?php

namespace App\Domains\Address\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\Address\Repositories\AddressRepository;

class AddressService extends AbstractService
{
    public function __construct(AddressRepository $repository)
    {
        $this->repository = $repository;
    }
}
