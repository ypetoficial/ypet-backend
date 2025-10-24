<?php

namespace App\Http\Controllers\Application;

use App\Domains\Application\Services\ApplicationService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\Application\StoreApplicationRequest;

class ApplicationController extends AbstractController
{
    public $requestValidate = StoreApplicationRequest::class;

    public function __construct(ApplicationService $service)
    {
        $this->service = $service;
    }
}
