<?php

namespace App\Domains\AnimalAmbulenceReason\Entities;

use App\Casts\EnumCast;
use App\Domains\Enums\AnimalAmbulencePriorityEnum;
use App\Models\AnimalAmbulenceReason;

class AnimalAmbulenceReasonEntity extends AnimalAmbulenceReason
{
    protected $table = 'animals_ambulences_reasons';

    protected $fillable = [
        'name',
        'priority',
        'color',
        'description',
    ];

    protected $casts = [
        'priority' => EnumCast::class.':'.AnimalAmbulencePriorityEnum::class,
    ];
}
