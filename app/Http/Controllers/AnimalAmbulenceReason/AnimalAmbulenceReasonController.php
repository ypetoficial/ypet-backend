<?php

namespace App\Http\Controllers\AnimalAmbulenceReason;

use App\Domains\AnimalAmbulenceReason\Services\AnimalAmbulenceReasonService;
use App\Http\Controllers\AbstractController;

class AnimalAmbulenceReasonController extends AbstractController
{
    public function __construct(AnimalAmbulenceReasonService $service)
    {
        $this->service = $service;
    }
}
