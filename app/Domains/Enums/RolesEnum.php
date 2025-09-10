<?php

namespace App\Domains\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum RolesEnum: string implements EnumInterface
{
    use EnumTrait;

    case SUPERUSER = 'superuser';
    case USER_ADMINISTRATOR = 'user_administrator';
    case USER_COLLABORATOR = 'user_collaborator';
    case USER_COMMON = 'user_common';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'SUPERUSER' => 'Superuser',
                'USER_ADMINISTRATOR' => 'User Administrator',
                'USER_COLLABORATOR' => 'User Collaborator',
                'USER_COMMON' => 'User Common',
            ],
            'es' => [
                'SUPERUSER' => 'Super usuario',
                'USER_ADMINISTRATOR' => 'Administrador de usuário',
                'USER_COLLABORATOR' => 'Colaborador de usuário',
                'USER_COMMON' => 'Usuário comum',
            ],
            'pt_BR' => [
                'SUPERUSER' => 'Super usuário',
                'USER_ADMINISTRATOR' => 'Administrador de função',
                'USER_COLLABORATOR' => 'Colaborador de função',
                'USER_COMMON' => 'Usuário comum',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}
