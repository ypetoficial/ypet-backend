<?php

namespace App\Domains\Address\Entities;

use App\Models\Address;

class AddressEntity extends Address
{
    protected $table = "address";

    protected $fillable = [
        'type',
        'zipcode',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
    ];

    public function addressable()
    {
        return $this->morphTo();
    }
}
