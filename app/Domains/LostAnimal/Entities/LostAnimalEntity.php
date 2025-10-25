<?php

namespace App\Domains\LostAnimal\Entities;

use App\Domains\Address\Entities\AddressEntity;
use App\Domains\Animal\Entities\AnimalEntity;
use App\Domains\User\Entities\UserEntity;
use App\Models\LostAnimal;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class LostAnimalEntity extends LostAnimal
{
    protected $table = 'lost_animals';

    protected $fillable = [
        'animal_id',
        'created_by',
        'lost_at',
        'lost_time',
    ];

    public function animal(): BelongsTo
    {
        return $this->belongsTo(AnimalEntity::class, 'animal_id');
    }

    public function address(): MorphOne
    {
        return $this->morphOne(AddressEntity::class, 'addressable');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(UserEntity::class, 'created_by');
    }

    public function status(): HasOne
    {
        return $this->hasOne(LostAnimalStatusEntity::class, 'lost_animal_id', 'id')->latest();
    }

    public function user(): BelongsTo
    {
        return $this->BelongsTo(UserEntity::class, 'created_by');
    }
}
