<?php

namespace App\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum AnimalSpeciesEnum: string implements EnumInterface
{
    use EnumTrait;

    case DOG = 'dog';
    case CAT = 'cat';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'DOG' => 'Dog',
                'CAT' => 'Cat',
            ],
            'es' => [
                'DOG' => 'Perro',
                'CAT' => 'Gato',
            ],
            'pt_BR' => [
                'DOG' => 'Cão',
                'CAT' => 'Gato',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}
