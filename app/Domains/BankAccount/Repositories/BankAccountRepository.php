<?php

namespace App\Domains\BankAccount\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\BankAccount\Entities\BankAccountEntity;

class BankAccountRepository extends AbstractRepository
{
    public function __construct(BankAccountEntity $model)
    {
        $this->model = $model;
    }
}
