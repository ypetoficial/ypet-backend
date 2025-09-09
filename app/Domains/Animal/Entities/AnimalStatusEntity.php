<?php

namespace App\Domains\Animal\Entities;

use App\Casts\EnumCast;
use App\Domains\Enums\AnimalStatusEnum;
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
    ];

    protected $casts = [
        'status' => EnumCast::class.':'.AnimalStatusEnum::class,
    ];

    public function animal(): BelongsTo
    {
        return $this->belongsTo(AnimalEntity::class, 'animal_id');
    }
}
