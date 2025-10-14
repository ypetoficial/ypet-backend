<?php

namespace App\Domains\Supplier\Entities;

use App\Models\Address;
use App\Models\Contact;
use App\Models\Supplier;

class SupplierEntity extends Supplier
{
    protected $table = 'suppliers';

    protected $fillable = [
        'status',
        'legal_name',
        'business_name',
        'document',
        'municipal_registration',
        'state_registration',
        'representative',
    ];

    protected $hidden = [
        'id',
    ];

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }
}
