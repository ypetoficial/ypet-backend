<?php

namespace App\Http\Controllers\BankAccount;

use App\Http\Controllers\AbstractController;
use App\Domains\BankAccount\Services\BankAccountService;


class BankAccountController extends AbstractController
{
    public function __construct(BankAccountService $service)
    {
        $this->service = $service;
    }
}
