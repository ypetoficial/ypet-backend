<?php

namespace App\Domains\AdoptionVisit\Entities;

use App\Domains\Animal\Entities\AnimalEntity;
use App\Domains\Citizen\Entities\CitizenEntity;
use App\Domains\User\Entities\UserEntity;
use App\Enums\AdoptionVisitStatus;
use App\Models\AdoptionVisit;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdoptionVisitEntity extends AdoptionVisit
{
    protected $table = 'adoption_visits';

    protected $fillable = [
        'uuid',
        'citizen_id',
        'animal_id',
        'start_date',
        'date_end',
        'status',
        'actions',
    ];

    protected $casts = [
        'status' => AdoptionVisitStatus::class,
    ];

    public function animal(): BelongsTo
    {
        return $this->belongsTo(AnimalEntity::class, 'animal_id');
    }

    public function user()
    {
        return $this->belongsTo(UserEntity::class);
    }

    public function citizen(): BelongsTo
    {
        return $this->belongsTo(CitizenEntity::class, 'citizen_id');
    }
}
