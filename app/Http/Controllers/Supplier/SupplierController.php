<?php

namespace App\Http\Controllers\Supplier;

use App\Domains\Supplier\Services\SupplierService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\Supplier\StoreSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;

class SupplierController extends AbstractController
{
    public $requestValidate = StoreSupplierRequest::class;

    public $requestValidateUpdate = UpdateSupplierRequest::class;

    public function __construct(SupplierService $service)
    {
        $this->service = $service;
    }
}
