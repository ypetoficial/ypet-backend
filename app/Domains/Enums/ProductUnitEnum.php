<?php

namespace App\Domains\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum ProductUnitEnum: string implements EnumInterface
{
    use EnumTrait;

    case ML = 'ml';
    case MG = 'mg';
    case G = 'g';
    case KG = 'kg';
    case UNIDADE = 'unidade';
    case DOSE = 'dose';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'ML' => 'ml',
                'MG' => 'mg',
                'G' => 'g',
                'KG' => 'kg',
                'UNIDADE' => 'unit',
                'DOSE' => 'dose',
            ],
            'es' => [
                'ML' => 'ml',
                'MG' => 'mg',
                'G' => 'g',
                'KG' => 'kg',
                'UNIDADE' => 'unidad',
                'DOSE' => 'dosis',
            ],
            'pt_BR' => [
                'ML' => 'ml',
                'MG' => 'mg',
                'G' => 'g',
                'KG' => 'kg',
                'UNIDADE' => 'unidade',
                'DOSE' => 'dose',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}