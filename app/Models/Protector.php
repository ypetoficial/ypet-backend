<?php

namespace App\Models;

use App\Common\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Protector extends Model
{
    /** @use HasFactory<\Database\Factories\ProtectorFactory> */
    use HasFactory, HasUuid;

    protected $fillable = [
        'tenant_id',
        'user_id',
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

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }
}
