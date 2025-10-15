<?php

namespace App\Domains\BankAccount\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\BankAccount\Repositories\BankAccountRepository;

class BankAccountService extends AbstractService
{
    public function __construct(BankAccountRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findByAccountable(string $accountableType, int $accountableId)
    {
        return $this->repository->where([
            'accountable_type' => $accountableType,
            'accountable_id' => $accountableId,
        ])->first();
    }
}
