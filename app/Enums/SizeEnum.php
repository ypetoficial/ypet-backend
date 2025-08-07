<?php

namespace App\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum SizeEnum: string implements EnumInterface
{
    use EnumTrait;

    case SMALL = 'small';
    case MEDIUM = 'medium';
    case LARGE = 'large';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'SMALL' => 'Small',
                'MEDIUM' => 'Medium',
                'LARGE' => 'Large',
            ],
            'es' => [
                'SMALL' => 'Pequeño',
                'MEDIUM' => 'Mediano',
                'LARGE' => 'Grande',
            ],
            'pt_BR' => [
                'SMALL' => 'Pequeno',
                'MEDIUM' => 'Médio',
                'LARGE' => 'Grande',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}
