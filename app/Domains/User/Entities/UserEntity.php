<?php

namespace App\Domains\User\Entities;

use App\Domains\Address\Entities\AddressEntity;
use App\Domains\Citizen\Entities\CitizenEntity;
use App\Models\AdoptionVisit;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserEntity extends User
{
    public $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'telephone',
        'cellphone',
        'password',
        'document',
    ];

    public function historyUserStatus(): HasMany
    {
        return $this->hasMany(UserStatusEntity::class, 'user_id', 'id');
    }

    public function status(): HasOne
    {
        return $this->hasOne(UserStatusEntity::class, 'user_id', 'id')->latest('created_at');
    }

    // public function adoptionVisit(): HasMany
    // {
    //     return $this->hasMany(AdoptionVisit::class, 'user_id');
    // }

    public function citizen(): HasOne
    {
        return $this->hasOne(CitizenEntity::class, 'user_id', 'id');
    }

    public function address(): HasOne
    {
        return $this->hasOne(AddressEntity::class, 'addressable_id', 'id')
            ->where('addressable_type', self::class);
    }
}
