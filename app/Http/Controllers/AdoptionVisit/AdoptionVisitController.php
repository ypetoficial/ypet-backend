<?php

namespace App\Http\Controllers\AdoptionVisit;

use App\Domains\AdoptionVisit\Services\AdoptionVisitService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\AdoptionVisit\StoreAdoptionVisitRequest;
use App\Http\Requests\AdoptionVisit\UpdateAdoptionVisitRequest;
use Illuminate\Http\Request;

class AdoptionVisitController extends AbstractController
{
    protected $requestValidate = StoreAdoptionVisitRequest::class;

    protected $requestValidateUpdate = UpdateAdoptionVisitRequest::class;

    public function __construct(AdoptionVisitService $service)
    {
        $this->service = $service;
    }

    public function confirm($uuid)
    {
        $this->service->confirm($uuid);

        return $this->success('Visita confirmada com sucesso');
    }

    public function reschedule(Request $request, $uuid)
    {
        $newDate = $request->get('start_date');

        $this->service->reschedule($uuid, $newDate);

        return $this->success('Visita remarcada com sucesso');
    }

    public function complete($uuid)
    {
        $this->service->complete($uuid);

        return $this->success('Visita concluída com sucesso');
    }

    public function cancel($uuid)
    {
        $this->service->cancel($uuid);

        return $this->success('Visita cancelada com sucesso');
    }
}
