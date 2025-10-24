<?php

namespace App\Domains\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum EvaluationAnimalStatusEnum: string implements EnumInterface
{
    use EnumTrait;

    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REFUSED = 'refused';

    public static function translations(string $locale = 'en'): array
    {
        $translations = [
            'en' => [
                'PENDING' => 'Pending',
                'APPROVED' => 'Approved',
                'REFUSED' => 'Refused',
            ],
            'es' => [
                'PENDING' => 'Pendiente',
                'APPROVED' => 'Aprobado',
                'REFUSED' => 'Rechazado',
            ],
            'pt_BR' => [
                'PENDING' => 'Pendente',
                'APPROVED' => 'Aprovado',
                'REFUSED' => 'Reprovado',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($translations, 'pt_BR'),
            'es' => data_get($translations, 'es'),
            default => data_get($translations, 'en'),
        };
    }
}
