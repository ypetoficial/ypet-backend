<?php

namespace App\Http\Controllers\Veterinarian;

use App\Http\Controllers\AbstractController;
use App\Http\Requests\StoreVetenirarianRequest;
use App\Http\Requests\UpdateVetenirarianRequest;
use App\Domains\Veterinarian\Services\VeterinarianService;

class VeterinarianController extends AbstractController
{
    protected $requestValidate = StoreVetenirarianRequest::class;

    protected $requestUpdateValidate = UpdateVetenirarianRequest::class;

    public function __construct(VeterinarianService $service)
    {
        $this->service = $service;
    }
}
