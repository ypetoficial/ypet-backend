<?php

namespace App\Domains\Vaccine\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\Vaccine\Repositories\VaccineRepository;
use Illuminate\Support\Facades\Auth;

class VaccineService extends AbstractService
{
    public function __construct(VaccineRepository $repository)
    {
        $this->repository = $repository;
    }

    public function beforeUpdate($id, array $data): array
    {
        $data['updated_by'] = Auth::user()?->id;

        return $data;
    }

    public function vaccineAlert()
    {
        return $this->getAllWithoutPagination(['expiration_date_not_null' => true]);
    }
}
