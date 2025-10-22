<?php

namespace App\Domains\Report\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\Report\Repositories\ReportRepository;
use App\Enums\ReportStatus;
use Illuminate\Support\Facades\Auth;

class ReportService extends AbstractService
{
    public function __construct(ReportRepository $repository)
    {
        $this->repository = $repository;
    }

    public function beforeSave(array $data): array
    {
        $data['reporter_id'] = Auth::user()?->id;

        return $data;
    }

    public function received($id)
    {
        return $this->repository->updateStatus($id, ReportStatus::IN_REVIEW);
    }

    public function forward($id)
    {
        return $this->repository->updateStatus($id, ReportStatus::FORWARD);
    }

    public function complete($id)
    {
        return $this->repository->updateStatus($id, ReportStatus::COMPLETE);
    }

    public function archive($id)
    {
        return $this->repository->updateStatus($id, ReportStatus::ARCHIVE);
    }
}
