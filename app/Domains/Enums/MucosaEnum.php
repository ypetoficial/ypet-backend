<?php

namespace App\Domains\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum MucosaEnum: string implements EnumInterface
{
    use EnumTrait;

    case PINK = 'pink';
    case PALE = 'pale';
    case CYANOTIC = 'cyanotic';
    case JAUNDICE = 'jaundice';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'PINK' => 'Pink',
                'PALE' => 'Pale',
                'CYANOTIC' => 'Cyanotic',
                'JAUNDICE' => 'Jaundice',
            ],
            'es' => [
                'PINK' => 'Pink',
                'PALE' => 'Pale',
                'CYANOTIC' => 'Cianótico',
                'JAUNDICE' => 'Ictérica',
            ],
            'pt_BR' => [
                'PINK' => 'Pink',
                'PALE' => 'Pale',
                'CYANOTIC' => 'Cianótica',
                'JAUNDICE' => 'Ictérica',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}
