<?php

namespace App\Listeners\Notification;

use App\Domains\Notification\Services\NotificationService;
use App\Events\LostAnimalClosed;
use Illuminate\Support\Facades\Log;

class SendLostAnimalClosedNotification
{
    public function __construct(
        private NotificationService $notificationService
    ) {}

    public function handle(LostAnimalClosed $event): void
    {
        try {
            Log::info('Sending lost animal closed notification', [
                'user_id' => $event->userId,
                'animal_id' => $event->animalId,
                'animal_name' => $event->animalName,
            ]);

            $this->notificationService->createAndSend([
                'user_id' => $event->userId,
                'title' => 'Pet Localizado',
                'message' => 'Seu Pet foi marcado como encontrado. O alerta foi encerrado.',
                'type' => 'confirmacao',
            ]);

            Log::info('Lost animal closed notification sent successfully', [
                'user_id' => $event->userId,
                'animal_id' => $event->animalId,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send lost animal closed notification', [
                'user_id' => $event->userId,
                'animal_id' => $event->animalId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}
