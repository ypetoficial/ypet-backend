<?php

namespace App\Domains\BankAccount\Repositories;

use App\Domains\BankAccount\Entities\BankAccountEntity;
use App\Domains\Abstracts\AbstractRepository;

class BankAccountRepository extends AbstractRepository
{
    public function __construct(BankAccountEntity $model)
    {
        $this->model = $model;
    }
}
