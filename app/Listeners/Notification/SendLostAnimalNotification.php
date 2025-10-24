<?php

namespace App\Listeners\Notification;

use App\Domains\Notification\Services\NotificationService;
use App\Events\LostAnimalCreated;
use Illuminate\Support\Facades\Log;

class SendLostAnimalNotification
{
    public function __construct(
        private NotificationService $notificationService
    ) {}

    public function handle(LostAnimalCreated $event): void
    {
        try {
            $ownerId = $event->lostAnimalEntity->created_by ?? null;
            $animalName = $event->lostAnimalEntity->animal->name ?? 'Pet';

            if (! $ownerId) {
                Log::warning('No owner found for lost animal notification', [
                    'lost_animal_id' => $event->lostAnimalEntity->id ?? null,
                ]);

                return;
            }

            Log::info('Sending lost animal notifications', [
                'owner_id' => $ownerId,
                'lost_animal_id' => $event->lostAnimalEntity->id ?? null,
                'animal_name' => $animalName,
            ]);

            $this->notificationService->createAndSend([
                'user_id' => $ownerId,
                'title' => 'Alerta Publicado',
                'message' => 'O alerta de desaparecimento do seu pet foi publicado com sucesso.',
                'type' => 'informativa',
            ]);

            $count = $this->notificationService->sendToAllUsers([
                'title' => 'Pet Perdido na Região',
                'message' => "Um pet chamado {$animalName} foi reportado como perdido. Ajude a encontrá-lo!",
                'type' => 'alerta',
                'action_label' => 'Ver detalhes',
                'action_target' => 'lost_pet_details',
            ]);

            Log::info('Lost animal notifications sent successfully', [
                'owner_notified' => true,
                'public_notifications_sent' => $count,
                'animal_name' => $animalName,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send lost animal notification', [
                'lost_animal_id' => $event->lostAnimalEntity->id ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}
