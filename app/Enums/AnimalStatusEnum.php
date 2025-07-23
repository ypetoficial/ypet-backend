<?php

namespace App\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum AnimalStatusEnum: string implements EnumInterface
{
    use EnumTrait;

    case FOR_ADOPTION = 'for_adoption';
    case WITH_OWNER = 'with_owner';
    case LOST = 'lost';
    case STOLEN = 'stolen';
    case DECEASED = 'deceased';
    case TARGETED_ADOPTION = 'targeted_adoption';
    case RESTRICTED = 'restricted';
    case IN_TRANSFER = 'in_transfer';
    case SHELTERED = 'sheltered';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'FOR_ADOPTION' => 'For Adoption',
                'WITH_OWNER' => 'Animal with Owner',
                'LOST' => 'Lost',
                'STOLEN' => 'Stolen',
                'DECEASED' => 'Deceased',
                'TARGETED_ADOPTION' => 'For Targeted Adoption',
                'RESTRICTED' => 'Restricted',
                'IN_TRANSFER' => 'In Transfer',
                'SHELTERED' => 'Sheltered',
            ],
            'pt_BR' => [
                'FOR_ADOPTION' => 'Para adoção',
                'WITH_OWNER' => 'Animal com tutor',
                'LOST' => 'Perdido',
                'STOLEN' => 'Furtado',
                'DECEASED' => 'Óbito',
                'TARGETED_ADOPTION' => 'Para adoção direcionada',
                'RESTRICTED' => 'Restrição',
                'IN_TRANSFER' => 'Em transferência',
                'SHELTERED' => 'Abrigado',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            default => data_get($locations, 'en'),
        };
    }
}
