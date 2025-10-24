<?php

namespace App\Listeners\Notification;

use App\Domains\Notification\Services\NotificationService;
use App\Events\SamupetRequestApproved;
use Illuminate\Support\Facades\Log;

class SendSamupetApprovalNotification
{
    public function __construct(
        private NotificationService $notificationService
    ) {}

    public function handle(SamupetRequestApproved $event): void
    {
        try {
            Log::info('Sending Samupet approval notification', [
                'user_id' => $event->userId,
                'request_id' => $event->requestId,
            ]);

            $this->notificationService->createAndSend([
                'user_id' => $event->userId,
                'title' => 'Solicitação Aprovada',
                'message' => 'Sua solicitação de resgate foi aprovada! A equipe entrará em contato.',
                'type' => 'confirmacao',
            ]);

            Log::info('Samupet approval notification sent successfully', [
                'user_id' => $event->userId,
                'request_id' => $event->requestId,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send Samupet approval notification', [
                'user_id' => $event->userId,
                'request_id' => $event->requestId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}
