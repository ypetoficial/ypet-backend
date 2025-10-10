<?php

namespace App\Domains\Protector\Entities;

use App\Domains\Address\Entities\AddressEntity;
use App\Models\Protector;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProtectorEntity extends Protector
{
    protected $table = 'protectors';

    protected $fillable = [
        'user_id',
        'uuid',
        'birth_date',
        'gender',
        'special_permissions',
        'status',
        'document',
        'updated_by',
    ];

    protected $hidden = [
        'user_id',
        'updated_at',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'user_id');
    }

    public function addresses()
    {
        return $this->morphMany(AddressEntity::class, 'addressable');
    }
}
