<?php

namespace App\Domains\Registration\Entities;

use App\Models\Registration;
use App\Domains\User\Entities\UserEntity;
use App\Domains\Animal\Entities\AnimalEntity;
use App\Domains\MobileClinicEvent\Entities\MobileClinicEventEntity;
use App\Casts\EnumCast;
use App\Enums\RegistrationStatusEnum;

class RegistrationEntity extends Registration
{
    protected $table = "registrations";

    protected $fillable = [
        'mobile_clinic_event_id',
        'user_id',
        'animal_id',
        'status',
    ];

    protected $casts = [
        'status' => EnumCast::class . ':' . RegistrationStatusEnum::class,
    ];

    public function mobileClinicEvent()
    {
        return $this->belongsTo(MobileClinicEventEntity::class);
    }

    public function user()
    {
        return $this->belongsTo(UserEntity::class);
    }

    public function animal()
    {
        return $this->belongsTo(AnimalEntity::class);
    }
}
