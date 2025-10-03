<?php

namespace App\Domains\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum HydrationEnum: string implements EnumInterface
{
    use EnumTrait;

    case HYDRATED = 'hydrated';
    case DEHYDRATED = 'dehydrated';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'HYDRATED' => 'Hydrated',
                'DEHYDRATED' => 'Dehydrated',
            ],
            'es' => [
                'HYDRATED' => 'Hidratado',
                'DEHYDRATED' => 'Dehidratado',
            ],
            'pt_BR' => [
                'HYDRATED' => 'Hidratado',
                'DEHYDRATED' => 'Dehidratado',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}
