<?php

namespace App\Domains\Contact\Entities;

use App\Models\Contact;

class ContactEntity extends Contact
{
    protected $table = 'contacts';

    protected $fillable = [
        'contactable_id',
        'contactable_type',
        'email',
        'telephone',
        'cellphone',
    ];

    protected $hidden = [
        'id',
    ];
}
