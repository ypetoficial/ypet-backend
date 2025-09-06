<?php

namespace App\Domains\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum MobileEventStatusEnum: string implements EnumInterface
{
    use EnumTrait;

    case OPEN = 'open';
    case CLOSED = 'closed';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'OPEN' => 'Open',
                'CLOSED' => 'Closed',
            ],
            'es' => [
                'OPEN' => 'Abierto',
                'CLOSED' => 'Cerrado',
            ],
            'pt_BR' => [
                'OPEN' => 'Aberto',
                'CLOSED' => 'Fechado',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}
