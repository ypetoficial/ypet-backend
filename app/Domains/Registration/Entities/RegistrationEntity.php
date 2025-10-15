<?php

namespace App\Domains\Registration\Entities;

use App\Casts\EnumCast;
use App\Domains\Animal\Entities\AnimalEntity;
use App\Domains\Enums\RegistrationStatusEnum;
use App\Domains\MobileClinicEvent\Entities\MobileClinicEventEntity;
use App\Domains\User\Entities\UserEntity;
use App\Models\Registration;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegistrationEntity extends Registration
{
    protected $table = 'registrations';

    protected $fillable = [
        'mobile_clinic_event_id',
        'user_id',
        'animal_id',
        'status',
        'created_at',
    ];

    protected $casts = [
        'status' => EnumCast::class.':'.RegistrationStatusEnum::class,
    ];

    public function mobileClinicEvent(): BelongsTo
    {
        return $this->belongsTo(MobileClinicEventEntity::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserEntity::class);
    }

    public function animal(): BelongsTo
    {
        return $this->belongsTo(AnimalEntity::class);
    }
}
