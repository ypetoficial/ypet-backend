<?php

namespace App\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum NotificationStatusEnum: string implements EnumInterface
{
    use EnumTrait;

    case LIDA = 'lida';
    case NAO_LIDA = 'nao_lida';

    public static function translations(string $locale = 'pt_BR'): array
    {
        return [
            'LIDA' => 'Lida',
            'NAO_LIDA' => 'Não Lida',
        ];
    }
}
