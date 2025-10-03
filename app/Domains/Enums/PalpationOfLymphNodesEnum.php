<?php

namespace App\Domains\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum PalpationOfLymphNodesEnum: string implements EnumInterface
{
    use EnumTrait;

    case NORMAL = 'normal';
    case ENLARGED = 'enlarged';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'NORMAL' => 'Normal',
                'ENLARGED' => 'Enlarged',
            ],
            'es' => [
                'NORMAL' => 'Normal',
                'ENLARGED' => 'Enlargados',
            ],
            'pt_BR' => [
                'NORMAL' => 'Normal',
                'ENLARGED' => 'Aumentados',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}
