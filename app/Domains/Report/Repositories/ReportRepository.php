<?php

namespace App\Domains\Report\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\Report\Entities\ReportEntity;
use App\Enums\ReportStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReportRepository extends AbstractRepository
{
    public function __construct(ReportEntity $model)
    {
        $this->model = $model;
    }

    public function updateStatus(int|string $id, ReportStatus $status)
    {
        $report = $this->find($id);

        if (! $report) {
            throw new \Exception('Denúncia não encontrada');
        }

        $user = Auth::user();

        $this->update($report, ['reporter_id' => $user->id, 'status' => $status->value]);

        Log::info('Transição de status de denúncia', [
            'user_id' => $user?->id,
            'user_email' => $user?->email,
            'timestamp' => now()->toDateTimeString(),
        ]);

        return $report;
    }
}
