<?php

namespace App\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum LostAnimalStatusEnum: string implements EnumInterface
{
    use EnumTrait;

    case FOUND = 'found';
    case LOST = 'lost';
    case DECEASED = 'deceased';

    public static function translations(string $locale = 'en'): array
    {
        $translations = [
            'en' => [
                'FOUND' => 'Found',
                'LOST' => 'Lost',
                'DECEASED' => 'Deceased',
            ],
            'es' => [
                'FOUND' => 'Encontrado',
                'LOST' => 'Perdido',
                'DECEASED' => 'Fallecido',
            ],
            'pt_BR' => [
                'FOUND' => 'Encontrado',
                'LOST' => 'Perdido',
                'DECEASED' => 'Óbito',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($translations, 'pt_BR'),
            'es' => data_get($translations, 'es'),
            default => data_get($translations, 'en'),
        };
    }
}
