<?php

namespace App\Domains\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum RegistrationStatusEnum: string implements EnumInterface
{
    use EnumTrait;

    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'PENDING' => 'Pending',
                'APPROVED' => 'Approved',
                'REJECTED' => 'Rejected',
            ],
            'es' => [
                'PENDING' => 'Pendiente',
                'APPROVED' => 'Aprobado',
                'REJECTED' => 'Rechazado',
            ],
            'pt_BR' => [
                'PENDING' => 'Pendente',
                'APPROVED' => 'Aprovado',
                'REJECTED' => 'Rejeitado',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}
