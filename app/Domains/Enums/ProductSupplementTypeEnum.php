<?php

namespace App\Domains\Enums;

use App\Domains\Abstracts\EnumInterface;
use App\Domains\Abstracts\EnumTrait;

enum ProductSupplementTypeEnum: string implements EnumInterface
{
    use EnumTrait;

    case VITAMINIC = 'vitaminic';
    case MINERAL = 'mineral';
    case PROTEIC = 'proteic';
    case CALORIC_ENERGETIC = 'caloric_energetic';
    case IMMUNOLOGIC = 'immunologic';
    case PROBIOTIC_DIGESTIVE = 'probiotic_digestive';
    case ARTICULAR = 'articular';
    case DERMATOLOGIC_CAPILLARY = 'dermatologic_capillary';

    public static function translations(string $locale = 'en'): array
    {
        $locations = [
            'en' => [
                'VITAMINIC' => 'Vitaminic',
                'MINERAL' => 'Mineral',
                'PROTEIC' => 'Proteic',
                'CALORIC_ENERGETIC' => 'Caloric/Energetic',
                'IMMUNOLOGIC' => 'Immunologic',
                'PROBIOTIC_DIGESTIVE' => 'Probiotic/Digestive',
                'ARTICULAR' => 'Articular',
                'DERMATOLOGIC_CAPILLARY' => 'Dermatologic/Capillary',
            ],
            'es' => [
                'VITAMINIC' => 'Vitamínico',
                'MINERAL' => 'Mineral',
                'PROTEIC' => 'Proteico',
                'CALORIC_ENERGETIC' => 'Calórico/Energético',
                'IMMUNOLOGIC' => 'Inmunológico',
                'PROBIOTIC_DIGESTIVE' => 'Probiótico/Digestivo',
                'ARTICULAR' => 'Articular',
                'DERMATOLOGIC_CAPILLARY' => 'Dermatológico/Capilar',
            ],
            'pt_BR' => [
                'VITAMINIC' => 'Vitamínico',
                'MINERAL' => 'Mineral',
                'PROTEIC' => 'Proteico',
                'CALORIC_ENERGETIC' => 'Calórico/Energético',
                'IMMUNOLOGIC' => 'Imunológico',
                'PROBIOTIC_DIGESTIVE' => 'Probiótico/Digestivo',
                'ARTICULAR' => 'Articular',
                'DERMATOLOGIC_CAPILLARY' => 'Dermatológico/Capilar',
            ],
        ];

        return match ($locale) {
            'pt_BR' => data_get($locations, 'pt_BR'),
            'es' => data_get($locations, 'es'),
            default => data_get($locations, 'en'),
        };
    }
}
