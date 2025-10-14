<?php

namespace App\Domains\MobileClinicEvent\Entities;

use App\Casts\EnumCast;
use App\Domains\Enums\AnimalSpeciesEnum;
use App\Domains\Enums\GenderEnum;
use App\Models\MobileClinicEventRule;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MobileClinicEventRuleEntity extends MobileClinicEventRule
{
    protected $table = 'mobile_clinic_event_rules';

    public $fillable = [
        'mobile_clinic_event_id',
        'specie',
        'gender',
        'max_registrations',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'specie' => EnumCast::class.':'.AnimalSpeciesEnum::class,
        'gender' => EnumCast::class.':'.GenderEnum::class,
        'max_registrations' => 'integer',
    ];

    public function mobileClinicEvent(): BelongsTo
    {
        return $this->belongsTo(MobileClinicEventEntity::class, 'mobile_clinic_event_id');
    }
}
