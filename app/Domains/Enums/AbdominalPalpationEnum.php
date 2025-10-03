<?php

namespace App\Domains\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum AbdominalPalpationEnum: string implements EnumInterface
{
    use EnumTrait;

    case NORMAL = 'normal';
    case ALTERED = 'altered';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'NORMAL' => 'Normal',
                'ALTERED' => 'Altered',
            ],
            'es' => [
                'NORMAL' => 'Normal',
                'ALTERED' => 'Alterado',
            ],
            'pt_BR' => [
                'NORMAL' => 'Normal',
                'ALTERED' => 'Alterado',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}
