<?php

namespace App\Domains\MobileClinicEvent\Entities;

use App\Models\MobileClinicEvent;
use App\Casts\EnumCast;
use App\Enums\MobileEventStatusEnum;

class MobileClinicEventEntity extends MobileClinicEvent
{
    protected $table = "mobile_clinic_events";

    protected $fillable = [
        'name',
        'description',
        'location',
        'start_date',
        'end_date',
        'status',
        'species',
        'gender',
    ];

    protected $casts = [
        'status' => EnumCast::class . ':' . MobileEventStatusEnum::class,
        'species' => 'array',
        'gender' => 'array',
    ];
}
