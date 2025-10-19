<?php

namespace App\Domains\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum TargetSpeciesEnum: string implements EnumInterface
{
    use EnumTrait;

    case DOG = 'dog';
    case CAT = 'cat';
    case BOTH = 'both';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'DOG' => 'Dog',
                'CAT' => 'Cat',
                'BOTH' => 'Both',
            ],
            'es' => [
                'DOG' => 'Perro',
                'CAT' => 'Gato',
                'BOTH' => 'Ambos',
            ],
            'pt_BR' => [
                'DOG' => 'Cão',
                'CAT' => 'Gato',
                'BOTH' => 'Ambos',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}
