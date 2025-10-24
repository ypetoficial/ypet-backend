<?php

namespace App\Listeners\Notification;

use App\Domains\Notification\Services\NotificationService;
use App\Events\AnimalAvailableForAdoption;
use Illuminate\Support\Facades\Log;

class SendAnimalAdoptionNotification
{
    public function __construct(
        private NotificationService $notificationService
    ) {}

    public function handle(AnimalAvailableForAdoption $event): void
    {
        try {
            Log::info('Sending animal adoption notification to all users', [
                'animal_id' => $event->animalId,
                'animal_name' => $event->animalName,
                'animal_type' => $event->animalType,
            ]);

            $count = $this->notificationService->sendToCitizensOnly([
                'title' => 'Pets Disponíveis',
                'message' => 'Novos pets estão disponíveis para adoção! Veja agora.',
                'type' => 'informativa',
                'action_label' => 'Ver pets',
                'action_target' => 'adoption_pets',
            ], true);

            Log::info('Animal adoption notification sent to all users', [
                'animal_id' => $event->animalId,
                'users_notified' => $count,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send animal adoption notification', [
                'animal_id' => $event->animalId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}
