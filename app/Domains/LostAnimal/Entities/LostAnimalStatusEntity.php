<?php

namespace App\Domains\LostAnimal\Entities;

use App\Models\LostAnimal;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LostAnimalStatusEntity extends LostAnimal
{
    protected $table = 'lost_animal_statuses';

    protected $fillable = [
        'lost_animal_id',
        'status',
        'description',
        'created_by',
    ];

    public function lostAnimal(): BelongsTo
    {
        return $this->belongsTo(LostAnimalEntity::class, 'lost_animal_id');
    }
}
