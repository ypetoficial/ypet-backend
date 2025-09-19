<?php

namespace App\Http\Controllers\Vaccine;

use App\Domains\Vaccine\Services\VaccineService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\Vaccine\StoreVaccineRequest;
use App\Http\Requests\Vaccine\UpdateVaccineRequest;

class VaccineController extends AbstractController
{
    public $requestValidate = StoreVaccineRequest::class;

    public $requestValidateUpdate = UpdateVaccineRequest::class;

    public function __construct(VaccineService $service)
    {
        $this->service = $service;
    }

    public function vaccineAlert()
    {
        return $this->service->vaccineAlert();
    }
}
