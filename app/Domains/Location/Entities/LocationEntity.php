<?php

namespace App\Domains\Location\Entities;

use App\Domains\Address\Entities\AddressEntity;
use App\Domains\Enums\LocationTypeEnum;
use App\Models\Location;

class LocationEntity extends Location
{
    protected $table = 'locations';

    protected $fillable = [
        'location_name',
        'location_type',
        'responsible_name',
        'phone',
        'email',
        'cnpj',
        'bank_account_or_pix',
        'status',
        'notes',
    ];

    protected $casts = [
        'location_type' => LocationTypeEnum::class,
    ];

    public function addresses()
    {
        return $this->morphMany(AddressEntity::class, 'addressable');
    }
}
