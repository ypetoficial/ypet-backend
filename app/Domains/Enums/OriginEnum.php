<?php

namespace App\Domains\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum OriginEnum: string implements EnumInterface
{
    use EnumTrait;

    case WEB = 'web';
    case MOBILE = 'mobile';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'WEB' => 'Painel',
                'MOBILE' => 'App',
            ],
            'es' => [
                'WEB' => 'Panel',
                'MOBILE' => 'Aplicación',
            ],
            'pt_BR' => [
                'WEB' => 'Painel',
                'MOBILE' => 'Aplicativo',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}
