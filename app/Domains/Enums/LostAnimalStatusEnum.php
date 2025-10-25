<?php

namespace App\Domains\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum LostAnimalStatusEnum: string implements EnumInterface
{
    use EnumTrait;

    case FOUND = 'found';
    case LOST = 'lost';
    case DECEASED = 'deceased';
    case CONCLUDE = 'conclude';

    public static function translations(string $locale = 'en'): array
    {
        $translations = [
            'en' => [
                'FOUND' => 'Found',
                'LOST' => 'Lost',
                'DECEASED' => 'Deceased',
                'CONCLUDE' => 'Conclude',
            ],
            'es' => [
                'FOUND' => 'Encontrado',
                'LOST' => 'Perdido',
                'DECEASED' => 'Fallecido',
                'CONCLUDE' => 'Finalizar',
            ],
            'pt_BR' => [
                'FOUND' => 'Encontrado',
                'LOST' => 'Perdido',
                'DECEASED' => 'Óbito',
                'CONCLUDE' => 'Concluído',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($translations, 'pt_BR'),
            'es' => data_get($translations, 'es'),
            default => data_get($translations, 'en'),
        };
    }
}
