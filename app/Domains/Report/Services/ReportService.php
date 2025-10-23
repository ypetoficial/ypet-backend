<?php

namespace App\Domains\Report\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\Address\Services\ReverseGeoCoderService;
use App\Domains\Files\FilesService;
use App\Domains\Report\Repositories\ReportRepository;
use App\Enums\ReportStatus;
use App\Events\ReportCompleted;
use App\Events\ReportReceived;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class ReportService extends AbstractService
{
    protected ReverseGeoCoderService $reverseGeoCoderService;

    protected FilesService $filesService;

    public function __construct(ReportRepository $repository)
    {
        $this->repository = $repository;
        $this->reverseGeoCoderService = app(ReverseGeoCoderService::class);
        $this->filesService = app(FilesService::class);
    }

    public function beforeSave(array $data): array
    {
        $rawAddress = $this->reverseGeoCoderService->reverseGeoCode($data['latitude'], $data['longitude']);
        $fileProcess = $this->filesService->processImage($data['picture']);
        $data['picture'] = $fileProcess;

        if (! $rawAddress) {
            throw new \Exception('Endereço não encontrado');
        }

        $data['reporter_id'] = Auth::user()?->id;
        $data['raw_address'] = $rawAddress;

        return $data;
    }

    public function afterSave($entity, array $params): void
    {
        $address = $this->reverseGeoCoderService->saveTheReversedAddress(
            data_get($params, 'raw_address'),
            $this->repository->getModel()::class,
            $entity->id
        );

        if (! $address) {
            throw new \Exception('Houve um erro ao salvar o endereço, tente novamente');
        }
    }

    public function received($id)
    {
        $report = $this->repository->updateStatus($id, ReportStatus::IN_REVIEW);

        Event::dispatch(new ReportReceived($report));

        return $report;
    }

    public function forward($id)
    {
        return $this->repository->updateStatus($id, ReportStatus::FORWARD);
    }

    public function complete($id)
    {
        $report = $this->repository->updateStatus($id, ReportStatus::COMPLETE);

        Event::dispatch(new ReportCompleted($report));

        return $report;
    }

    public function archive($id)
    {
        return $this->repository->updateStatus($id, ReportStatus::ARCHIVE);
    }
}
