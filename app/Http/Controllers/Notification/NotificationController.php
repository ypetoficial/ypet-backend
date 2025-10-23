<?php

namespace App\Http\Controllers\Notification;

use App\Domains\Notification\Services\NotificationService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\Notification\StoreNotificationRequest;
use App\Http\Requests\Notification\UpdateNotificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NotificationController extends AbstractController
{
    public $requestValidate = StoreNotificationRequest::class;

    public $requestValidateUpdate = UpdateNotificationRequest::class;

    public function __construct(NotificationService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): JsonResponse
    {
        try {
            $user = $request->user();
            $perPage = $request->get('per_page', 20);

            if ($perPage > 100) {
                $perPage = 100;
            }

            $notifications = $this->service->getUserNotifications($user->id, [
                'per_page' => $perPage,
                'order_by' => ['column' => 'created_at', 'direction' => 'desc'],
            ]);

            Log::info('Notifications listed', [
                'user_id' => $user->id,
                'total' => $notifications->total(),
                'per_page' => $perPage,
            ]);

            return response()->json([
                'success' => true,
                'data' => $notifications->map(function ($notification) {
                    return [
                        'id' => $notification->id,
                        'title' => $notification->title,
                        'message' => $notification->message,
                        'type' => $notification->type,
                        'datetime' => $notification->created_at->toISOString(),
                        'status' => $notification->status === 'nao_lida' ? 'não lida' : 'lida',
                        'action_label' => $notification->action_label,
                        'action_target' => $notification->action_target,
                    ];
                }),
                'pagination' => [
                    'current_page' => $notifications->currentPage(),
                    'total' => $notifications->total(),
                    'per_page' => $notifications->perPage(),
                    'last_page' => $notifications->lastPage(),
                    'from' => $notifications->firstItem(),
                    'to' => $notifications->lastItem(),
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to list notifications', [
                'user_id' => $request->user()->id ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erro ao carregar notificações',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }

    public function markAsRead(Request $request, $id): JsonResponse
    {
        try {
            $user = $request->user();
            $success = $this->service->markAsRead($id, $user->id);

            if ($success) {
                return response()->json([
                    'success' => true,
                    'message' => 'Notificação marcada como lida',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Notificação não encontrada ou não pertence ao usuário',
                ], 404);
            }
        } catch (\Exception $e) {
            Log::error('Failed to mark notification as read', [
                'notification_id' => $id,
                'user_id' => $request->user()->id ?? null,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erro ao marcar notificação como lida',
            ], 500);
        }
    }

    public function unreadCount(Request $request): JsonResponse
    {
        try {
            $user = $request->user();
            $count = $this->service->getUnreadCount($user->id);

            return response()->json([
                'success' => true,
                'count' => $count,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to get unread count', [
                'user_id' => $request->user()->id ?? null,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erro ao contar notificações não lidas',
            ], 500);
        }
    }

    public function markAllAsRead(Request $request): JsonResponse
    {
        try {
            $user = $request->user();
            $count = $this->service->markAllAsRead($user->id);

            return response()->json([
                'success' => true,
                'message' => 'Todas as notificações foram marcadas como lidas',
                'count' => $count,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to mark all notifications as read', [
                'user_id' => $request->user()->id ?? null,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erro ao marcar todas as notificações como lidas',
            ], 500);
        }
    }

    public function testPush(Request $request): JsonResponse
    {
        try {
            $user = $request->user();

            if (! $user->fcm_token) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuário não possui FCM token configurado',
                    'has_token' => false,
                ], 400);
            }

            $notification = $this->service->save([
                'user_id' => $user->id,
                'title' => 'Teste de Push Notification',
                'message' => 'Esta é uma notificação de teste para verificar se o Firebase está funcionando!',
                'type' => 'informativa',
                'action_label' => 'Ver teste',
                'action_target' => 'test_screen',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Notificação de teste enviada',
                'notification_id' => $notification->id,
                'push_sent' => true,
                'has_token' => true,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send test push notification', [
                'user_id' => $request->user()->id ?? null,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erro ao enviar notificação de teste',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }
}
