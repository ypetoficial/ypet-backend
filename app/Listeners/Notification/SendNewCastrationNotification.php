<?php

namespace App\Listeners\Notification;

use App\Domains\Notification\Services\NotificationService;
use App\Events\MobileClinicEventCreated;
use Illuminate\Support\Facades\Log;

class SendNewCastrationNotification
{
    public function __construct(
        private NotificationService $notificationService
    ) {}

    public function handle(MobileClinicEventCreated $event): void
    {
        try {
            Log::info('Sending new castration notification to all users', [
                'mobile_clinic_event_id' => $event->entity->id ?? null,
            ]);

            $count = $this->notificationService->sendToCitizensOnly([
                'title' => 'Nova Data de Castração',
                'message' => 'Novas vagas disponíveis para castração! Confira os horários e agende seu pet.',
                'type' => 'informativa',
                'action_label' => 'Ver agendamento',
                'action_target' => 'castration_schedule',
            ], true);

            Log::info('New castration notification sent to all users', [
                'mobile_clinic_event_id' => $event->entity->id ?? null,
                'users_notified' => $count,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send new castration notification', [
                'mobile_clinic_event_id' => $event->entity->id ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}
