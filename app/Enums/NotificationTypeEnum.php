<?php

namespace App\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum NotificationTypeEnum: string implements EnumInterface
{
    use EnumTrait;

    case ALERTA = 'alerta';
    case LEMBRETE = 'lembrete';
    case CONFIRMACAO = 'confirmacao';
    case INFORMATIVA = 'informativa';

    public static function translations(string $locale = 'pt_BR'): array
    {
        return [
            'ALERTA' => 'Alerta',
            'LEMBRETE' => 'Lembrete',
            'CONFIRMACAO' => 'Confirmação',
            'INFORMATIVA' => 'Informativa',
        ];
    }
}
