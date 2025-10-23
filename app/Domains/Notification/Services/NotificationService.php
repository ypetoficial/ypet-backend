<?php

namespace App\Domains\Notification\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\Notification\Repositories\NotificationRepository;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class NotificationService extends AbstractService
{
    private FirebaseService $firebaseService;

    public function __construct(NotificationRepository $repository)
    {
        $this->repository = $repository;
        $this->firebaseService = app(FirebaseService::class);
    }

    public function getUserNotifications(int $userId, array $options = [])
    {
        return $this->repository->getUserNotifications($userId, $options);
    }

    public function afterSave($entity, array $params)
    {
        $this->sendFirebaseNotification($entity);

        return $entity;
    }

    public function createAndSend(array $data)
    {
        return $this->save($data);
    }

    private function sendFirebaseNotification($notification)
    {
        try {
            Log::info('Notification created', [
                'id' => $notification->id,
                'user_id' => $notification->user_id,
                'title' => $notification->title,
            ]);

            if ($notification->user && $notification->user->fcm_token) {
                $sent = $this->firebaseService->sendNotification(
                    $notification->user->fcm_token,
                    [
                        'title' => $notification->title,
                        'message' => $notification->message,
                        'data' => [
                            'type' => $notification->type,
                            'action_target' => $notification->action_target,
                            'notification_id' => $notification->id,
                        ],
                    ]
                );

                if ($sent) {
                    $notification->update(['sent_at' => now()]);
                    Log::info('Notification sent via Firebase', ['id' => $notification->id]);
                } else {
                    Log::warning('Failed to send notification via Firebase', ['id' => $notification->id]);
                }
            } else {
                Log::info('User has no Firebase token, notification saved only', [
                    'user_id' => $notification->user_id,
                    'notification_id' => $notification->id,
                ]);
            }

            return $notification;
        } catch (\Exception $e) {
            Log::error('Failed to send Firebase notification', [
                'notification_id' => $notification->id ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }

    public function sendToAllUsers(array $data, bool $requiresPermission = false): int
    {
        $users = User::all();
        $count = 0;
        $pushCount = 0;

        Log::info('Sending notification to all users', [
            'total_users' => $users->count(),
            'users_with_fcm_token' => User::whereNotNull('fcm_token')->count(),
            'requires_permission' => $requiresPermission,
            'title' => $data['title'] ?? 'N/A',
        ]);

        foreach ($users as $user) {
            try {
                if ($requiresPermission && ! $user->fcm_token) {
                    continue;
                }

                $notificationData = array_merge($data, ['user_id' => $user->id]);
                $this->save($notificationData);
                $count++;

                if ($user->fcm_token) {
                    $pushCount++;
                }
            } catch (\Exception $e) {
                Log::error('Failed to send notification to user', [
                    'user_id' => $user->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        Log::info('Bulk notification completed', [
            'total_notifications_created' => $count,
            'total_users' => $users->count(),
            'users_with_push_notifications' => $pushCount,
        ]);

        return $count;
    }

    public function sendToCitizensOnly(array $data, bool $requiresPermission = false): int
    {
        $citizens = User::whereDoesntHave('roles')->get();
        $count = 0;

        foreach ($citizens as $user) {
            if ($requiresPermission && ! $user->fcm_token) {
                continue;
            }

            $notificationData = array_merge($data, ['user_id' => $user->id]);
            $this->save($notificationData);
            $count++;
        }

        return $count;
    }

    public function markAsRead(int $id, int $userId): bool
    {
        $result = $this->repository->markAsRead($id, $userId);

        if ($result) {
            Log::info('Notification marked as read', [
                'notification_id' => $id,
                'user_id' => $userId,
            ]);
        }

        return $result;
    }

    public function getUnreadCount(int $userId): int
    {
        return $this->repository->getUnreadCount($userId);
    }

    public function markAllAsRead(int $userId): int
    {
        $count = $this->repository->markAllAsRead($userId);

        Log::info('All notifications marked as read', [
            'user_id' => $userId,
            'count' => $count,
        ]);

        return $count;
    }
}
