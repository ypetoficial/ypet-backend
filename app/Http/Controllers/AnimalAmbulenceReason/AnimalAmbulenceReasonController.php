<?php

namespace App\Http\Controllers\AnimalAmbulenceReason;

use App\Http\Controllers\AbstractController;
use App\Domains\AnimalAmbulenceReason\Services\AnimalAmbulenceReasonService;


class AnimalAmbulenceReasonController extends AbstractController
{
    public function __construct(AnimalAmbulenceReasonService $service)
    {
        $this->service = $service;
    }
}
