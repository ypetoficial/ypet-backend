<?php

namespace App\Models;

use App\Common\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Citizen extends Model
{
    /** @use HasFactory<\Database\Factories\CitizenFactory> */
    use HasFactory, HasUuid;

    protected $fillable = [
        'hash',
        'user_id',
        'tenant_id',
        'company_id',
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

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }
}
