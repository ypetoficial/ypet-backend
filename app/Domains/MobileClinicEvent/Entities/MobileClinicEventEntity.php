<?php

namespace App\Domains\MobileClinicEvent\Entities;

use App\Casts\EnumCast;
use App\Domains\Enums\AnimalSpeciesEnum;
use App\Domains\Enums\GenderEnum;
use App\Domains\Enums\MobileEventStatusEnum;
use App\Domains\Registration\Entities\RegistrationEntity;
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
        'max_registrations',
    ];

    protected $casts = [
        'status' => EnumCast::class.':'.MobileEventStatusEnum::class,
        'species' => EnumCast::class.':'.AnimalSpeciesEnum::class,
        'gender' => EnumCast::class.':'.GenderEnum::class,
        'max_registrations' => 'integer',
    ];

    protected $appends = [
        'current_registrations',
    ];

    public function isStatusOpen(): bool
    {
        $status = Arr::get($this->attributes, 'status');

        return $status === MobileEventStatusEnum::OPEN->value;
    }

    public function registrations()
    {
        return $this->hasMany(RegistrationEntity::class, 'mobile_clinic_event_id');
    }

    public function getCurrentRegistrationsAttribute(): int
    {
        return $this->registrations()->count();
    }
}
