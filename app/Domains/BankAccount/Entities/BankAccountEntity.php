<?php

namespace App\Domains\BankAccount\Entities;

use App\Casts\EnumCast;
use App\Domains\Enums\BankAccountPixTypeEnum;
use App\Domains\Enums\BankAccountTypeEnum;
use App\Models\BankAccount;

class BankAccountEntity extends BankAccount
{
    protected $table = "bank_accounts";

    public $fillable = [
        'accountable_type',
        'accountable_id',
        'account_type',
        'bank_code',
        'bank_name',
        'agency',
        'account_number',
        'account_holder_name',
        'account_holder_document',
        'pix_key',
        'pix_key_type',
    ];

    protected $casts = [
        'account_type' => EnumCast::class . ':' . BankAccountTypeEnum::class,
        'pix_key_type' => EnumCast::class . ':' . BankAccountPixTypeEnum::class,
    ];
}
