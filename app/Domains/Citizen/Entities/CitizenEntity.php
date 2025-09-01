<?php

namespace App\Domains\Citizen\Entities;

use App\Models\User;
use App\Models\Tenant;
use App\Models\Address;
use App\Models\Citizen;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CitizenEntity extends Citizen
{
    protected $table = "citizens";

    protected $fillable = [
        'user_id',
        'tenant_id',
        'name',
        'document',
        'email',
        'phone',
        'observations',
        'birth_date',
        'gender',
        'special_permissions',
        'can_report_abuse',
        'can_mobile_castration',
        'status',
        'updated_by'
    ];

    protected $hidden = [
        'user_id',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
       return $this->belongsTo(User::class, 'user_id');
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }
}