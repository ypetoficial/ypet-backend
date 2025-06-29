<?php

namespace App\Ypet\Common\Enums;

enum RoleEnum: string
{
    case ADMIN = 'ADMIN';
    case OPERATOR = 'OPERATOR';

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Admin',
            self::OPERATOR => 'Operator',
        };
    }
}
