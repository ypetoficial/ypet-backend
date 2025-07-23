<?php

namespace App\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum GenderEnum: string implements EnumInterface
{
    use EnumTrait;

    case MALE = 'male';
    case FEMALE = 'female';
    case UNKNOWN = 'unknown';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'MALE' => 'Male',
                'FEMALE' => 'Female',
                'UNKNOWN' => 'Unknown',
            ],
            'es' => [
                'MALE' => 'Macho',
                'FEMALE' => 'Hembra',
                'UNKNOWN' => 'Desconocido',
            ],
            'pt_BR' => [
                'MALE' => 'Macho',
                'FEMALE' => 'Fêmea',
                'UNKNOWN' => 'Desconhecido',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}
