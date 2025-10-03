<?php

namespace App\Http\Controllers\PreSurgeryAssessment;

use App\Domains\PreSurgeryAssessment\Services\PreSurgeryAssessmentService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\StorePreSurgeryAssessmentRequest;

class PreSurgeryAssessmentController extends AbstractController
{
    protected $requestValidate = StorePreSurgeryAssessmentRequest::class;

    public function __construct(PreSurgeryAssessmentService $service)
    {
        $this->service = $service;
    }
}
