<?php

namespace App\Domains\Enums;

enum LocationTypeEnum: string
{
    case PET_HOTEL = 'pet_hotel';
    case TEMPORARY_HOME = 'temporary_home';
    case MUNICIPAL_TEMPORARY_SHELTER = 'municipal_temporary_shelter';
    case PARTNER_CLINICS = 'partner_clinics';
    case VETERINARY_HOSPITAL = 'veterinary_hospital';
    case ADOPT_HERE = 'adopt_here';
    case SHELTER_PROTECTOR = 'shelter_protector';

    public function label(): string
    {
        return match ($this) {
            self::PET_HOTEL => 'Hotel Pet',
            self::TEMPORARY_HOME => 'Lar Temporário',
            self::MUNICIPAL_TEMPORARY_SHELTER => 'Abrigo Temporário Municipal (em construção)',
            self::PARTNER_CLINICS => 'Clínicas Conveniadas',
            self::VETERINARY_HOSPITAL => 'Hospital Veterinário',
            self::ADOPT_HERE => 'Adote Aqui',
            self::SHELTER_PROTECTOR => 'Abrigo / Protetor',
        };
    }
}
