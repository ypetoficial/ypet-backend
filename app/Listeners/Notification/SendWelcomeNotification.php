<?php

namespace App\Listeners\Notification;

use App\Domains\Notification\Services\NotificationService;
use App\Events\UserCreated;
use Illuminate\Support\Facades\Log;

class SendWelcomeNotification
{
    public function __construct(
        private NotificationService $notificationService
    ) {}

    public function handle(UserCreated $event): void
    {
        try {
            Log::info('Sending welcome notification', [
                'user_id' => $event->userEntity->id,
                'user_email' => $event->userEntity->email ?? 'N/A',
            ]);

            $this->notificationService->createAndSend([
                'user_id' => $event->userEntity->id,
                'title' => 'Bem-vindo ao YPet',
                'message' => 'Explore todas as funcionalidades do aplicativo e ajude a proteger os animais.',
                'type' => 'informativa',
            ]);

            Log::info('Welcome notification sent successfully', [
                'user_id' => $event->userEntity->id,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send welcome notification', [
                'user_id' => $event->userEntity->id ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}
