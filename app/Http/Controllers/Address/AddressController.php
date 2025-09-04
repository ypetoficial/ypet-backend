<?php

namespace App\Http\Controllers\Address;

use App\Domains\Address\Services\AddressService;
use App\Http\Controllers\AbstractController;

class AddressController extends AbstractController
{
    public function __construct(AddressService $service)
    {
        $this->service = $service;
    }
}
