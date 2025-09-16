<?php

namespace App\Domains\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum BooleanEnum: int implements EnumInterface
{
    use EnumTrait;

    case TRUE = 1;
    case FALSE = 0;

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'TRUE' => 'Yes',
                'FALSE' => 'No',
            ],
            'es' => [
                'TRUE' => 'Sí',
                'FALSE' => 'No',
            ],
            'pt_BR' => [
                'TRUE' => 'Sim',
                'FALSE' => 'Não',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}
