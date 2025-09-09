<?php

namespace App\Domains\Animal\Entities;

use App\Casts\EnumCast;
use App\Domains\Enums\OriginEnum;
use App\Models\AnimalEntryData;

class AnimalEntryDataEntity extends AnimalEntryData
{
    protected $table = 'animal_entry_datas';

    protected $casts = [
        'origin' => EnumCast::class.':'.OriginEnum::class,
    ];

    protected $fillable = [
        'animal_id',
        'entry_date',
        'castrated',
        'castration_at',
        'castration_site',
        'dewormed',
        'infirmity',
        'origin',
        'collection_site',
        'collection_reason',
        'registration_number',
        'microchip_number',
    ];
}
