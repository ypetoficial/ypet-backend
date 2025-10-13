<?php

namespace App\Domains\Collaborator\Entities;

use App\Domains\BankAccount\Entities\BankAccountEntity;
use App\Domains\User\Entities\UserEntity;
use App\Models\Collaborator;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class CollaboratorEntity extends Collaborator
{
    protected $table = "collaborators";

    public $fillable = [
        'user_id',
        'cnpj',
        'work_started_at',
        'work_ended_at',
        'observations',
    ];

    protected $casts = [
        'work_started_at' => 'datetime',
        'work_ended_at' => 'datetime',
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(UserEntity::class, 'user_id');
    }

    public function bankAccount(): MorphOne
    {
        return $this->morphOne(BankAccountEntity::class, 'accountable');
    }
}
