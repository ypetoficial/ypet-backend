<?php

namespace App\Domains\AdoptionVisit\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\AdoptionVisit\Repositories\AdoptionVisitRepository;
use App\Enums\AdoptionVisitStatus;
use Illuminate\Support\Facades\Auth;

class AdoptionVisitService extends AbstractService
{
    public function __construct(AdoptionVisitRepository $repository)
    {
        $this->repository = $repository;
    }

    public function confirm($id)
    {
        if (Auth::user()->hasRole('user_common')) {
            abort(403, 'Usuário comum não pode confirmar essa ação.');
        }

        return $this->repository->updateStatus($id, AdoptionVisitStatus::CONFIRMED);
    }

    public function reschedule($id, string $newDate)
    {
        return $this->repository->updateStatus(
            $id,
            AdoptionVisitStatus::RESCHEDULED,
            $newDate
        );
    }

    public function complete($id)
    {
        return $this->repository->updateStatus($id, AdoptionVisitStatus::COMPLETED);
    }

    public function cancel($id)
    {
        return $this->repository->updateStatus($id, AdoptionVisitStatus::CANCELED);
    }
}
