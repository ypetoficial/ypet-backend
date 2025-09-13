<?php

namespace App\Domains\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum StatusProtectorEnum: string implements EnumInterface
{
    use EnumTrait;

    case PENDING = 'pending';
    case IN_ANALYSIS = 'in_analysis';
    case APPROVED = 'approved';
    case REFUSED = 'refused';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'PENDING' => 'Pending',
                'IN_ANALYSIS' => 'In analysis',
                'APPROVED' => 'Approved',
                'REFUSED' => 'Refused',
            ],
            'es' => [
                'PENDING' => 'Pendiente',
                'IN_ANALYSIS' => 'En análisis',
                'APPROVED' => 'Aprobado',
                'REFUSED' => 'Rechazado',
            ],
            'pt_BR' => [
                'PENDING' => 'Pendente',
                'IN_ANALYSIS' => 'Em análise',
                'APPROVED' => 'Aprovado',
                'REFUSED' => 'Recusado',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}
