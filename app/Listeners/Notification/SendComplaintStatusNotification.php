<?php

namespace App\Listeners\Notification;

use App\Domains\Notification\Services\NotificationService;
use App\Events\ComplaintStatusUpdated;
use Illuminate\Support\Facades\Log;

class SendComplaintStatusNotification
{
    public function __construct(
        private NotificationService $notificationService
    ) {}

    public function handle(ComplaintStatusUpdated $event): void
    {
        try {
            Log::info('Sending complaint status notification', [
                'user_id' => $event->userId,
                'complaint_id' => $event->complaintId,
                'new_status' => $event->newStatus,
            ]);

            $this->notificationService->createAndSend([
                'user_id' => $event->userId,
                'title' => 'Atualização de Denúncia',
                'message' => 'Sua denúncia foi analisada e encaminhada para os órgãos responsáveis.',
                'type' => 'informativa',
                'action_label' => 'Ver detalhes',
                'action_target' => 'complaint_details',
            ]);

            Log::info('Complaint status notification sent successfully', [
                'user_id' => $event->userId,
                'complaint_id' => $event->complaintId,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send complaint status notification', [
                'user_id' => $event->userId,
                'complaint_id' => $event->complaintId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}
