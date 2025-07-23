<?php

namespace App\Domains\Animal\Entities;

use App\Models\Animal;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AnimalEntity extends Animal
{
    protected $table = 'animals';

    protected $fillable = [
        'hash',
        'tenant_id',
        'company_id',
        'tutor_id',
        'name',
        'type',
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
        'profile_picture',
        'collection_site',
        'collection_reason',
        'microchip_number',
        'registration_number',
    ];

    protected $casts = [
        'weight' => 'integer',
        'birth_date' => 'date',
        'castrated' => 'boolean',
        'entry_date' => 'date',
        'castration_at' => 'date',
    ];

    public function tutor(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'tutor_id');
    }

    public function historyAnimalStatus(): HasMany
    {
        return $this->hasMany(AnimalStatusEntity::class, 'animal_id', 'id');
    }
}
