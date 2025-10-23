<?php

namespace App\Enums;

enum ReportStatus: string
{
    case IN_REVIEW = 'in_review';
    case FORWARD = 'forward';
    case COMPLETE = 'complete';
    case ARCHIVE = 'archive';

    public function label(): string
    {
        return match ($this) {
            self::IN_REVIEW => 'Em análise',
            self::FORWARD => 'Encaminhada',
            self::COMPLETE => 'Concluída',
            self::ARCHIVE => 'Arquivada',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::IN_REVIEW => 'Denúncia recebida e aguardando análise.',
            self::FORWARD => 'Denúncia encaminhada ao órgão responsável.',
            self::COMPLETE => 'Caso finalizado e comunicado ao denunciante.',
            self::ARCHIVE => 'Encerrada manualmente pela equipe',
        };
    }
}
