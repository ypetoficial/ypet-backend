<?php

namespace App\Http\Controllers\BankAccount;

use App\Domains\BankAccount\Services\BankAccountService;
use App\Http\Controllers\AbstractController;

class BankAccountController extends AbstractController
{
    public function __construct(BankAccountService $service)
    {
        $this->service = $service;
    }
}
