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
    case DELETED = 'deleted';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'ACTIVE' => 'Active',
                'INACTIVE' => 'Inactive',
                'SUSPENDED' => 'Suspended',
                'DELETED' => 'Deleted',
            ],
            'es' => [
                'ACTIVE' => 'Activo',
                'INACTIVE' => 'Inactivo',
                'SUSPENDED' => 'Suspendido',
                'DELETED' => 'Eliminado',
            ],
            'pt_BR' => [
                'ACTIVE' => 'Ativo',
                'INACTIVE' => 'Inativo',
                'SUSPENDED' => 'Suspenso',
                'DELETED' => 'Deletado',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}
