<?php

namespace App\Domains\User\Entities;

use App\Models\User;
use App\Models\UserStatus;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserStatusEntity extends UserStatus
{
    protected $table = 'user_statuses';

    protected $fillable = [
        'user_id',
        'status',
        'description',
        'created_by',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'user_id',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
