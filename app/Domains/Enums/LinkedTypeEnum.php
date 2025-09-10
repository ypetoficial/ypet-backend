<?php

namespace App\Domains\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum LinkedTypeEnum: int implements EnumInterface
{
    use EnumTrait;

    case EFFECTIVE = 1;
    case VOLUNTARY = 2;
    case CONVENIATED = 3;

    public function label(): string
    {
        return match ($this) {
            self::EFFECTIVE => 'Efetivo',
            self::VOLUNTARY => 'Voluntário',
            self::CONVENIATED => 'Conveniado',
        };
    }

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'EFFECTIVE' => 'Effective',
                'VOLUNTARY' => 'Voluntary',
                'CONVENIATED' => 'Conveniated',
            ],
            'pt_BR' => [
                'EFFECTIVE' => 'Efetivo',
                'VOLUNTARY' => 'Voluntário',
                'CONVENIATED' => 'Conveniado',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            default => data_get($locations, 'en'),
        };
    }
}
