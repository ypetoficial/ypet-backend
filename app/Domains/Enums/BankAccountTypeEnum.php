<?php

namespace App\Domains\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum BankAccountTypeEnum: string implements EnumInterface
{
    use EnumTrait;

    case CURRENT_ACCOUNT = 'current_account';
    case PIX_ACCOUNT = 'pix_account';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'CURRENT_ACCOUNT' => 'Current Account',
                'PIX_ACCOUNT' => 'Pix Account',
            ],
            'es' => [
                'CURRENT_ACCOUNT' => 'Cuenta Corriente',
                'PIX_ACCOUNT' => 'Cuenta Pix',
            ],
            'pt_BR' => [
                'CURRENT_ACCOUNT' => 'Conta Corrente',
                'PIX_ACCOUNT' => 'Conta Pix',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}
