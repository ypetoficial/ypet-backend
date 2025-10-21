<?php

namespace App\Domains\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum ProductCategoryEnum: string implements EnumInterface
{
    use EnumTrait;

    case VACCINE = 'vaccine';
    case VERMIFUGE = 'vermifuge';
    case MEDICATION = 'medication';
    case SUPPLEMENT = 'supplement';
    case FOOD = 'food';
    case OTHER = 'other';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'VACCINE' => 'Vaccine',
                'VERMIFUGE' => 'Vermifuge',
                'MEDICATION' => 'Medication',
                'SUPPLEMENT' => 'Supplement',
                'FOOD' => 'Food',
                'OTHER' => 'Other',
            ],
            'es' => [
                'VACCINE' => 'Vacuna',
                'VERMIFUGE' => 'Vermífugo',
                'MEDICATION' => 'Medicamento',
                'SUPPLEMENT' => 'Suplemento',
                'FOOD' => 'Alimento',
                'OTHER' => 'Otro',
            ],
            'pt_BR' => [
                'VACCINE' => 'Vacina',
                'VERMIFUGE' => 'Vermífugo',
                'MEDICATION' => 'Medicação',
                'SUPPLEMENT' => 'Suplemento',
                'FOOD' => 'Alimento',
                'OTHER' => 'Outro',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}
