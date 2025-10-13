<?php

namespace App\Domains\BankAccount\Services;

use App\Domains\BankAccount\Repositories\BankAccountRepository;
use App\Domains\Abstracts\AbstractService;

class BankAccountService extends AbstractService
{
    public function __construct(BankAccountRepository $repository)
    {
        $this->repository = $repository;
    }
}
