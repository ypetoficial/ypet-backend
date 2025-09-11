<?php

namespace App\Domains\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum AnimalCoatEnum: string implements EnumInterface
{
    use EnumTrait;

    case SHORT = 'short';
    case MEDIUM = 'medium';
    case LONG = 'long';
    case HAIRLESS = 'hairless';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'SHORT' => 'Short',
                'MEDIUM' => 'Medium',
                'LONG' => 'Long',
                'HAIRLESS' => 'Hairless',
            ],
            'es' => [
                'SHORT' => 'Corto',
                'MEDIUM' => 'Mediano',
                'LONG' => 'Largo',
                'HAIRLESS' => 'Sin pelo',
            ],
            'pt_BR' => [
                'SHORT' => 'Curto',
                'MEDIUM' => 'Médio',
                'LONG' => 'Longo',
                'HAIRLESS' => 'Sem pelo',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}
