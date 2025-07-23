<?php

namespace App\Domains\Animal\Entities;

use App\Models\Animal;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnimalStatusEntity extends Animal
{
    protected $table = 'animal_statuses';

    protected $fillable = [
        'status',
        'description',
        'animal_id',
        'created_by',
        'tenant_id',
        'company_id',
    ];

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class, 'animal_id');
    }
}
