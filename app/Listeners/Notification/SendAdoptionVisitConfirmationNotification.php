<?php

namespace App\Listeners\Notification;

use App\Domains\Notification\Services\NotificationService;
use App\Events\AdoptionVisitConfirmed;
use Illuminate\Support\Facades\Log;

class SendAdoptionVisitConfirmationNotification
{
    public function __construct(
        private NotificationService $notificationService
    ) {}

    public function handle(AdoptionVisitConfirmed $event): void
    {
        try {
            $animal = null;
            $protectorId = null;
            if (method_exists($event->adoptionVisit, 'animal') && $event->adoptionVisit->animal) {
                $animal = $event->adoptionVisit->animal;
                $protectorId = $animal->user_id;
            } else {
                if (isset($event->adoptionVisit->animal_id)) {
                    $animal = \App\Models\Animal::find($event->adoptionVisit->animal_id);
                    if ($animal) {
                        $protectorId = $animal->user_id;
                    }
                }
            }

            if (! $protectorId) {
                Log::warning('No protector found for adoption visit confirmation', [
                    'adoption_visit_id' => $event->adoptionVisit->id ?? null,
                    'animal_id' => $event->adoptionVisit->animal_id ?? null,
                ]);

                $protectorId = 3;
                Log::info('Using test user for adoption visit notification', ['user_id' => $protectorId]);
            }

            Log::info('Sending adoption visit confirmation notification', [
                'adoption_visit_id' => $event->adoptionVisit->id,
                'protector_id' => $protectorId,
                'animal_id' => $animal->id ?? null,
            ]);

            $this->notificationService->createAndSend([
                'user_id' => $protectorId,
                'title' => 'Visita de Adoção Confirmada',
                'message' => 'Uma visita foi agendada para o seu pet!',
                'type' => 'confirmacao',
                'action_label' => 'Ver detalhes',
                'action_target' => 'adoption_visit_details',
            ]);

            Log::info('Adoption visit confirmation notification sent successfully', [
                'adoption_visit_id' => $event->adoptionVisit->id,
                'protector_id' => $protectorId,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send adoption visit confirmation notification', [
                'adoption_visit_id' => $event->adoptionVisit->id ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}
