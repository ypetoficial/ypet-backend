<?php

namespace App\Domains\Citizen\Entities;

use App\Domains\Address\Entities\AddressEntity;
use App\Models\Citizen;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CitizenEntity extends Citizen
{
    protected $table = 'citizens';

    protected $fillable = [
        'observations',
        'birth_date',
        'gender',
        'special_permissions',
        'can_report_abuse',
        'can_mobile_castration',
        'status',
        'updated_by',
        'user_id',
        'document',
    ];

    protected $hidden = [
        'user_id',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function addresses()
    {
        return $this->morphMany(AddressEntity::class, 'addressable');
    }
}
