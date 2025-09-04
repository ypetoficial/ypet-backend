<?php

namespace App\Domains\LostAnimal\Entities;

use App\Casts\EnumCast;
use App\Enums\LostAnimalStatusEnum;
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

    protected $casts = [
        'status' => EnumCast::class.':'.LostAnimalStatusEnum::class,
    ];

    public function lostAnimal(): BelongsTo
    {
        return $this->belongsTo(LostAnimalEntity::class, 'lost_animal_id');
    }
}
