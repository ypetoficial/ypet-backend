<?php

namespace App\Domains\MobileClinicEvent\Entities;

use App\Casts\EnumCast;
use App\Domains\Enums\MobileEventStatusEnum;
use App\Models\MobileClinicEvent;

class MobileClinicEventEntity extends MobileClinicEvent
{
    protected $table = 'mobile_clinic_events';

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
        'status' => EnumCast::class.':'.MobileEventStatusEnum::class,
        'species' => 'array',
        'gender' => 'array',
    ];
}
