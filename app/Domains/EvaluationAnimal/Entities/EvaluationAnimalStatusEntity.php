<?php

namespace App\Domains\EvaluationAnimal\Entities;

use App\Domains\Animal\Entities\AnimalEntity;
use App\Domains\User\Entities\UserEntity;
use App\Models\EvaluationAnimalStatus;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EvaluationAnimalStatusEntity extends EvaluationAnimalStatus
{
    protected $table = 'evaluations_animal_statuses';

    protected $fillable = [
        'animal_id',
        'status',
        'tutor_id',
    ];

    public function Animal(): BelongsTo
    {
        return $this->belongsTo(AnimalEntity::class, 'animal_id');
    }

    public function Tutor(): BelongsTo
    {
        return $this->belongsTo(UserEntity::class, 'tutor_id');
    }
}
