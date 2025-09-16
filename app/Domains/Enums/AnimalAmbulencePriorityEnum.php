<?php

namespace App\Domains\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum AnimalAmbulencePriorityEnum: string implements EnumInterface
{
    use EnumTrait;

    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'LOW' => 'Low',
                'MEDIUM' => 'Medium',
                'HIGH' => 'High',
            ],
            'es' => [
                'LOW' => 'Bajo',
                'MEDIUM' => 'Medio',
                'HIGH' => 'Alto',
            ],
            'pt_BR' => [
                'LOW' => 'Baixo',
                'MEDIUM' => 'Medio',
                'HIGH' => 'Alto',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}
