<?php

namespace App\Domains\Address\Entities;

use App\Models\Address;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class AddressEntity extends Address
{
    protected $table = 'addresses';

    protected $fillable = [
        'addressable_id',
        'addressable_type',
        'street',
        'number',
        'complement',
        'district',
        'city',
        'state',
        'zip_code',
        'country',
        'latitude',
        'longitude',
    ];

    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }
}
