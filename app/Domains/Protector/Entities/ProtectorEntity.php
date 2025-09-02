<?php

namespace App\Domains\Protector\Entities;

use App\Models\User;
use App\Models\Tenant;
use App\Models\Address;
use App\Models\Protector;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProtectorEntity extends Protector
{
    protected $table = "protectors";

    protected $fillable = [
        'tenant_id',
        'uuid',
        'name',
        'document',
        'email',
        'phone',
        'birth_date',
        'gender',
        'special_permissions',
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