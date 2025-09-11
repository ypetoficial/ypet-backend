<?php

namespace App\Http\Controllers\Veterinarian;

use App\Domains\Veterinarian\Services\VeterinarianService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\Veterinarian\StoreVeterinarianRequest;
use App\Http\Requests\Veterinarian\UpdateVeterinarianRequest;

class VeterinarianController extends AbstractController
{
    protected $requestValidate = StoreVeterinarianRequest::class;

    protected $requestUpdateValidate = UpdateVeterinarianRequest::class;

    public function __construct(VeterinarianService $service)
    {
        $this->service = $service;
    }
}
