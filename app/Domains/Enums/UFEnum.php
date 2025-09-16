<?php

namespace App\Domains\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum UFEnum: string implements EnumInterface
{
    use EnumTrait;

    case MG = 'MG';
    case SP = 'SP';
    case RJ = 'RJ';
    case ES = 'ES';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'MG' => 'Minas Gerais',
                'SP' => 'São Paulo',
                'RJ' => 'Rio de Janeiro',
                'ES' => 'Espírito Santo',
            ],
            'es' => [
                'MG' => 'Minas Gerais',
                'SP' => 'São Paulo',
                'RJ' => 'Rio de Janeiro',
                'ES' => 'Espírito Santo',
            ],
            'pt_BR' => [
                'MG' => 'Minas Gerais',
                'SP' => 'São Paulo',
                'RJ' => 'Rio de Janeiro',
                'ES' => 'Espírito Santo',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}
