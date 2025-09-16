<?php

namespace App\Domains\AnimalAmbulance\Entities;

use App\Domains\Address\Entities\AddressEntity;
use App\Domains\User\Entities\UserEntity;
use App\Domains\Enums\AnimalAmbulencePriorityEnum;
use App\Domains\Enums\AnimalAmbulenceStatusEnum;
use App\Models\AnimalAmbulance;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class AnimalAmbulanceEntity extends AnimalAmbulance
{
    protected $table = 'animal_ambulances';

    protected $fillable = [
        'user_id',
        'priority',
        'status',
        'evidence_path',
    ];

    protected $casts = [
        'priority' => AnimalAmbulencePriorityEnum::class,
        'status' => AnimalAmbulenceStatusEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserEntity::class);
    }

    public function address(): MorphOne
    {
        return $this->morphOne(AddressEntity::class, 'addressable');
    }
}
