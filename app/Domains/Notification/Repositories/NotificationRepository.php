<?php

namespace App\Domains\Notification\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\Notification\Entities\NotificationEntity;

class NotificationRepository extends AbstractRepository
{
    public function __construct(NotificationEntity $model)
    {
        $this->model = $model;
    }

    public function getUserNotifications(int $userId, array $options = [])
    {
        $perPage = data_get($options, 'per_page', 20);
        $orderBy = data_get($options, 'order_by.column', 'created_at');
        $direction = data_get($options, 'order_by.direction', 'desc');

        return $this->model
            ->where('user_id', $userId)
            ->orderBy($orderBy, $direction)
            ->paginate($perPage);
    }

    public function markAsRead(int $id, int $userId): bool
    {
        return $this->model
            ->where('id', $id)
            ->where('user_id', $userId)
            ->update(['status' => 'lida']) > 0;
    }

    public function getUnreadCount(int $userId): int
    {
        return $this->model
            ->where('user_id', $userId)
            ->where('status', 'nao_lida')
            ->count();
    }

    public function markAllAsRead(int $userId): int
    {
        return $this->model
            ->where('user_id', $userId)
            ->where('status', 'nao_lida')
            ->update(['status' => 'lida']);
    }
}
