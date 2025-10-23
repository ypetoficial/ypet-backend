<?php

namespace App\Listeners\Notification;

use App\Domains\Notification\Services\NotificationService;
use App\Events\LostAnimalFound;
use Illuminate\Support\Facades\Log;

class SendLostAnimalFoundNotification
{
    public function __construct(
        private NotificationService $notificationService
    ) {}

    public function handle(LostAnimalFound $event): void
    {
        try {
            Log::info('Sending lost animal found notification', [
                'user_id' => $event->userId,
                'animal_id' => $event->animalId,
                'animal_name' => $event->animalName,
            ]);

            $this->notificationService->createAndSend([
                'user_id' => $event->userId,
                'title' => 'Pet Encontrado',
                'message' => 'Alguém pode ter encontrado o seu pet! Nossa equipe entrará em contato para mais detalhes.',
                'type' => 'alerta',
            ]);

            Log::info('Lost animal found notification sent successfully', [
                'user_id' => $event->userId,
                'animal_id' => $event->animalId,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send lost animal found notification', [
                'user_id' => $event->userId,
                'animal_id' => $event->animalId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}
