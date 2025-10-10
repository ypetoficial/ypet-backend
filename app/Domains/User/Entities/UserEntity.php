<?php

namespace App\Domains\User\Entities;

use App\Domains\Address\Entities\AddressEntity;
use App\Domains\Citizen\Entities\CitizenEntity;
use App\Domains\Protector\Entities\ProtectorEntity;
use App\Models\AdoptionVisit;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class UserEntity extends User
{
    public $table = 'users';

    protected $fillable = [
        'id',
        'name',
        'email',
        'onboarding_done',
        'fcm_token',
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

    public function citizen(): ?HasOne
    {
        return $this->hasOne(CitizenEntity::class, 'user_id', 'id');
    }

    public function protector(): HasOne
    {
        return $this->hasOne(ProtectorEntity::class, 'user_id', 'id');
    }

    public function addresses(): MorphMany
    {
        return $this->morphMany(AddressEntity::class, 'addressable');
    }

    public function getMorphClass()
    {
        return User::class;
    }
}
