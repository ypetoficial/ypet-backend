<?php

namespace App\Domains\User\Entities;

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
    ];

    public function historyUserStatus(): HasMany
    {
        return $this->hasMany(UserStatusEntity::class, 'user_id', 'id');
    }

    public function status(): HasOne
    {
        return $this->hasOne(UserStatusEntity::class, 'user_id', 'id')->latest('created_at');
    }
}
