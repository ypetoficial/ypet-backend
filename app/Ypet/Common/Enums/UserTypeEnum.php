<?php

namespace App\Ypet\Common\Enums;

enum UserTypeEnum: int
{
    case INTERNAL = 1;
    case EXTERNAL = 2;

    public function label(): string
    {
        return match ($this) {
            self::INTERNAL => 'Internal',
            self::EXTERNAL => 'External',
        };
    }
}
