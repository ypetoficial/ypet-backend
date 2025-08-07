<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    /** @use HasFactory<\Database\Factories\AnimalFactory> */
    use HasFactory;

    protected $fillable = [
        'hash',
        'tenant_id',
        'company_id',
        'place_id',
        'citizen_id',
        'type',
        'breed',
        'status',
        'name',
        'color',
        'size',
        'birth_date',
        'gender',
        'profile_picture',
        'castrated',
        'castration_at',
        'castration_site',
        'registration_number',
        'entry_date',
        'collection_site',
        'collection_reason',
        'microchip',
        'tracker_number',
        'medal_code',
    ];
}
