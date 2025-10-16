<?php

namespace App\Domains\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum RolesEnum: string implements EnumInterface
{
    use EnumTrait;

    case SUPERUSER = 'superuser';
    case MANAGER_ADMINISTRATOR = 'manager_administrator';
    case USER_VETERINARIAN = 'user_veterinarian';
    case USER_AGENT = 'user_agent';
    case USER_CITIZEN = 'user_citizen';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'SUPERUSER' => 'Superuser',
                'MANAGER_ADMINISTRATOR' => 'Manager Administrator',
                'USER_VETERINARIAN' => 'User Veterinarian',
                'USER_AGENT' => 'User Agent',
                'USER_CITIZEN' => 'User Citizen',
            ],
            'es' => [
                'SUPERUSER' => 'Super usuario',
                'MANAGER_ADMINISTRATOR' => 'Administrador de gerente',
                'USER_VETERINARIAN' => 'Usuario veterinario',
                'USER_AGENT' => 'Agente de usuario',
                'USER_CITIZEN' => 'Usuario ciudadano',
            ],
            'pt_BR' => [
                'SUPERUSER' => 'Super usuário',
                'MANAGER_ADMINISTRATOR' => 'Administrador Gerente',
                'USER_VETERINARIAN' => 'Usuário Veterinário',
                'USER_AGENT' => 'Usuário Agente',
                'USER_CITIZEN' => 'Usuário Cidadão',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}
