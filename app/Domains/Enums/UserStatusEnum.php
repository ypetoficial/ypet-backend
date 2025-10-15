<?php

namespace App\Domains\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum UserStatusEnum: string implements EnumInterface
{
    use EnumTrait;

    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case SUSPENDED = 'suspended';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'ACTIVE' => 'Active',
                'INACTIVE' => 'Inactive',
                'SUSPENDED' => 'Suspended',
            ],
            'es' => [
                'ACTIVE' => 'Activo',
                'INACTIVE' => 'Inactivo',
                'SUSPENDED' => 'Suspendido',
            ],
            'pt_BR' => [
                'ACTIVE' => 'Ativo',
                'INACTIVE' => 'Inativo',
                'SUSPENDED' => 'Suspenso',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}
