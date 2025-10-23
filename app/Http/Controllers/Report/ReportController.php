<?php

namespace App\Http\Controllers\Report;

use App\Domains\Report\Services\ReportService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\Report\StoreReportRequest;
use App\Http\Requests\Report\UpdateReportRequest;

class ReportController extends AbstractController
{
    public $requestValidate = StoreReportRequest::class;

    public $requestValidateUpdate = UpdateReportRequest::class;

    public function __construct(ReportService $service)
    {
        $this->service = $service;
    }

    public function received($uuid)
    {
        $this->service->received($uuid);

        return $this->success('Denúncia marcada como recebida');
    }

    public function forward($uuid)
    {
        $this->service->forward($uuid);

        return $this->success('Denúncia marcada como encaminhada');
    }

    public function complete($uuid)
    {
        $this->service->complete($uuid);

        return $this->success('Denúncia marcada como concluída');
    }

    public function archive($uuid)
    {
        $this->service->archive($uuid);

        return $this->success('Denúncia arquivada com sucesso');
    }
}
