<?php

namespace App\Enums;

enum AdoptionVisitStatus: string
{
    case PENDING = 'pending';
    case CONFIRMED = 'confirmed';
    case RESCHEDULED = 'rescheduled';
    case COMPLETED = 'completed';
    case CANCELED = 'canceled';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pendente',
            self::CONFIRMED => 'Confirmada',
            self::RESCHEDULED => 'Remarcada',
            self::COMPLETED => 'Concluída',
            self::CANCELED => 'Cancelada',
        };
    }
}
