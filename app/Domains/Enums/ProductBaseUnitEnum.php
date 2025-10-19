<?php

namespace App\Domains\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum ProductBaseUnitEnum: string implements EnumInterface
{
    use EnumTrait;

    case ML = 'ml';
    case G = 'g';
    case KG = 'kg';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'ML' => 'ml',
                'G' => 'g',
                'KG' => 'kg',
            ],
            'es' => [
                'ML' => 'ml',
                'G' => 'g',
                'KG' => 'kg',
            ],
            'pt_BR' => [
                'ML' => 'ml',
                'G' => 'g',
                'KG' => 'kg',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}