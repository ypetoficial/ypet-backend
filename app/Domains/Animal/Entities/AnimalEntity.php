<?php

namespace App\Domains\Animal\Entities;

use App\Casts\EnumCast;
use App\Enums\AnimalCoatEnum;
use App\Enums\AnimalSpeciesEnum;
use App\Enums\GenderEnum;
use App\Enums\SizeEnum;
use App\Models\Animal;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AnimalEntity extends Animal
{
    protected $table = 'animals';

    protected $fillable = [
        'hash',
        'tenant_id',
        'company_id',
        'tutor_id',
        'name',
        'species',
        'gender',
        'weight',
        'birth_date',
        'castrated',
        'castration_at',
        'castration_site',
        'size',
        'color',
        'coat',
        'characteristics',
        'surname',
        'entry_date',
        'picture',
        'collection_site',
        'collection_reason',
        'microchip_number',
        'registration_number',
    ];

    protected $casts = [
        'species' => EnumCast::class.':'.AnimalSpeciesEnum::class,
        'gender' => EnumCast::class.':'.GenderEnum::class,
        'size' => EnumCast::class.':'.SizeEnum::class,
        'coat' => EnumCast::class.':'.AnimalCoatEnum::class,
        'weight' => 'float',
        'birth_date' => 'date',
        'castrated' => 'boolean',
        'entry_date' => 'date',
        'castration_at' => 'date',
    ];

    public function tutor(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'tutor_id');
    }

    public function historyStatuses(): HasMany
    {
        return $this->hasMany(AnimalStatusEntity::class, 'animal_id', 'id');
    }

    public function status(): HasOne
    {
        return $this->hasOne(AnimalStatusEntity::class, 'animal_id', 'id')->latest();
    }
}
