<?php

namespace App\Domains\Notification\Entities;

use App\Domains\User\Entities\UserEntity;
use App\Enums\NotificationStatusEnum;
use App\Enums\NotificationTypeEnum;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificationEntity extends Notification
{
    protected $table = 'notifications';

    protected $casts = [
        'type' => NotificationTypeEnum::class,
        'status' => NotificationStatusEnum::class,
        'sent_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserEntity::class, 'user_id');
    }
}
