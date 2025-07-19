<?php

namespace App\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum RolesEnum: string implements EnumInterface
{
    use EnumTrait;

    case USER_ADMINISTRATOR = 'user_administrator';
    case ROLE_ADMINISTRATOR = 'role_administrator';
    case ANIMAL_ADMINISTRATOR = 'animal_administrator';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'ROLE_ADMINISTRATOR' => 'Role Administrator',
                'USER_ADMINISTRATOR' => 'User Administrator',
                'ANIMAL_ADMINISTRATOR' => 'Animal Administrator',
            ],
            'es' => [
                'ROLE_ADMINISTRATOR' => 'Administrador de Role',
                'USER_ADMINISTRATOR' => 'Administrador de Usuario',
                'ANIMAL_ADMINISTRATOR' => 'Administrador de Animal',
            ],
            'pt_BR' => [
                'ROLE_ADMINISTRATOR' => 'Administrador de função',
                'USER_ADMINISTRATOR' => 'Administrador de usuário',
                'ANIMAL_ADMINISTRATOR' => 'Administrador de animal',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}
