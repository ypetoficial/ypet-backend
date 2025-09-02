<?php

namespace App\Http\Controllers\Protector;

use App\Http\Controllers\AbstractController;
use App\Domains\Protector\Services\ProtectorService;
use App\Http\Requests\Protector\StoreProtectorRequest;
use App\Http\Requests\Protector\UpdateProtectorRequest;


class ProtectorController extends AbstractController
{
    public $requestValidate = StoreProtectorRequest::class;

    public $requestValidateUpdate = UpdateProtectorRequest::class;

    public function __construct(ProtectorService $service)
    {
        $this->service = $service;
    }
}
