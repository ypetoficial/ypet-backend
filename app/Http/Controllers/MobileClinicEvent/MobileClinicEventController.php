<?php

namespace App\Http\Controllers\MobileClinicEvent;

use App\Http\Controllers\AbstractController;
use App\Domains\MobileClinicEvent\Services\MobileClinicEventService;


class MobileClinicEventController extends AbstractController
{
    public function __construct(MobileClinicEventService $service)
    {
        $this->service = $service;
    }
}
