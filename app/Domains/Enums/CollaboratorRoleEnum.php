<?php

namespace App\Domains\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;
enum CollaboratorRoleEnum: string implements EnumInterface
{
    use EnumTrait;

    case MANAGER_ADMINISTRATOR = 'manager_administrator';
    case USER_AGENT = 'user_agent';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'MANAGER_ADMINISTRATOR' => 'Manager Administrator',
                'USER_AGENT' => 'User Agent',
            ],
            'es' => [
                'MANAGER_ADMINISTRATOR' => 'Administrador de gerente',
                'USER_AGENT' => 'Agente de usuario',
            ],
            'pt_BR' => [
                'MANAGER_ADMINISTRATOR' => 'Administrador Gerente',
                'USER_AGENT' => 'Usuário Agente',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}
