<?php

namespace App\Http\Controllers\Location;

use App\Domains\Location\Services\LocationService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\Location\StoreLocationRequest;
use App\Http\Requests\Location\UpdateLocationRequest;

class LocationController extends AbstractController
{
    public $requestValidate = StoreLocationRequest::class;

    public $requestValidateUpdate = UpdateLocationRequest::class;

    public function __construct(LocationService $service)
    {
        $this->service = $service;
    }
}
