<?php

namespace App\Domains\MobileClinicEvent\Entities;

use App\Casts\EnumCast;
use App\Domains\Enums\AnimalSpeciesEnum;
use App\Domains\Enums\GenderEnum;
use App\Domains\Enums\MobileEventStatusEnum;
use App\Models\MobileClinicEvent;
use Illuminate\Support\Arr;

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
        'species' => EnumCast::class.':'.AnimalSpeciesEnum::class,
        'gender' => EnumCast::class.':'.GenderEnum::class,
    ];

    public function isStatusOpen(): bool
    {
        $status = Arr::get($this->attributes, 'status');

        return $status === MobileEventStatusEnum::OPEN->value;
    }
}
