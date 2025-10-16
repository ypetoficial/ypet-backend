<?php

namespace App\Domains\Vaccine\Entities;

use App\Models\Vaccine;

class VaccineEntity extends Vaccine
{
    protected $table = 'vaccines';

    protected $attributes = [
        'status' => 'active',
    ];

    protected $fillable = [
        'uuid',
        'name',
        'type',
        'status',
        'purpose',
        'target_specie',
        'dose_count',
        'dose_interval',
        'manu_facturer',
        'expiration_date',
        'batch',
        'updated_by',
        'alert_at',
        'alert_sent',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('active', fn ($query) => $query->where('status', 'Active'));
    }
}
