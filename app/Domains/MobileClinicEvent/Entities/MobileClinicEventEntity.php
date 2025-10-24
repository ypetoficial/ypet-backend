<?php

namespace App\Domains\MobileClinicEvent\Entities;

use App\Casts\EnumCast;
use App\Domains\Enums\MobileEventStatusEnum;
use App\Domains\Location\Entities\LocationEntity;
use App\Domains\Registration\Entities\RegistrationEntity;
use App\Models\MobileClinicEvent;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;

class MobileClinicEventEntity extends MobileClinicEvent
{
    protected $table = 'mobile_clinic_events';

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
        'location_id',
    ];

    protected $casts = [
        'status' => EnumCast::class.':'.MobileEventStatusEnum::class,
    ];

    protected $appends = [
        'current_registrations',
        'max_registrations',
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

    public function location()
    {
        return $this->belongsTo(LocationEntity::class, 'location_id');
    }

    public function rules(): HasMany
    {
        return $this->hasMany(MobileClinicEventRuleEntity::class, 'mobile_clinic_event_id');
    }

    public function getCurrentRegistrationsAttribute(): int
    {
        return $this->registrations()->count();
    }

    public function getCurrentRegistrationByGenderAttribute(string $gender): int
    {
        return $this->registrations()
            ->join('animals', 'registrations.animal_id', '=', 'animals.id')
            ->where('animals.gender', $gender)
            ->count();
    }

    public function getMaxRegistrationsAttribute(): int
    {
        return $this->rules()->sum('max_registrations');
    }
}
