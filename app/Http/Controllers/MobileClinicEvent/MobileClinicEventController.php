<?php

namespace App\Http\Controllers\MobileClinicEvent;

use App\Http\Controllers\AbstractController;
use App\Http\Requests\MobileClinic\MobileClinicRequest;
use App\Domains\MobileClinicEvent\Services\MobileClinicEventService;

class MobileClinicEventController extends AbstractController
{
    protected $requestValidate = MobileClinicRequest::class;

    public function __construct(MobileClinicEventService $service)
    {
        $this->service = $service;
    }
}
