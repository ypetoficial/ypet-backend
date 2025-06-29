<?php

namespace App\Ypet\Common\Enums;

enum UserStatusEnum: int
{
    case DISABLED = 0;
    case ACTIVE = 1;
    case SUSPENDED = 2;
    case TRIAL = 3;

    public function label(): string
    {
        return match ($this) {
            self::DISABLED => 'Disabled',
            self::ACTIVE => 'Active',
            self::SUSPENDED => 'Suspended',
            self::TRIAL => 'Trial',
        };
    }
}
