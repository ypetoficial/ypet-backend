<?php

namespace App\Domains\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum AnimalAmbulenceStatusEnum: string implements EnumInterface
{
    use EnumTrait;

    case OPEN = 'open';
    case DESIGNATED = 'designated';
    case IN_ATTENDANCE = 'in_attendance';
    case COMPLETED = 'completed';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'OPEN' => 'Open',
                'DESIGNATED' => 'Designated',
                'IN_ATTENDANCE' => 'In Attendance',
                'COMPLETED' => 'Completed',
            ],
            'es' => [
                'OPEN' => 'Abierto',
                'DESIGNATED' => 'Designado',
                'IN_ATTENDANCE' => 'En Atención',
                'COMPLETED' => 'Completado',
            ],
            'pt_BR' => [
                'OPEN' => 'Aberto',
                'DESIGNATED' => 'Designado',
                'IN_ATTENDANCE' => 'Em Atendimento',
                'COMPLETED' => 'Concluído',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}
