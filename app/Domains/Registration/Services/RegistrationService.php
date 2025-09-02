<?php

namespace App\Domains\Registration\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\Animal\Services\AnimalService;
use App\Domains\MobileClinicEvent\Services\MobileClinicEventService;
use App\Domains\Registration\Repositories\RegistrationRepository;
use App\Enums\MobileEventStatusEnum;

class RegistrationService extends AbstractService
{
    protected AnimalService $animalService;

    protected MobileClinicEventService $mobileClinicEventService;

    public function __construct(RegistrationRepository $repository)
    {
        $this->repository = $repository;
        $this->animalService = app(AnimalService::class);
        $this->mobileClinicEventService = app(MobileClinicEventService::class);
    }

    public function beforeSave(array $data): array
    {
        $animal = $this->animalService->find($data['animal_id']);
        $mobileClinicEvent = $this->mobileClinicEventService->find($data['mobile_clinic_event_id']);

        $this->validateAnimalRegistration($animal, $data['user_id']);
        $this->validateEventAvailability($mobileClinicEvent);
        $this->validateAnimalSpecies($animal, $mobileClinicEvent);

        return $data;
    }

    private function validateAnimalRegistration($animal, $userId): void
    {
        if ($animal->mobileClinicEvent()->exists()) {
            throw new \Exception('Animal já está cadastrado em um evento');
        }

        if ($animal->user_id != $userId) {
            throw new \Exception('Animal não pertence ao usuário');
        }
    }

    private function validateEventAvailability($mobileClinicEvent): void
    {
        if ($mobileClinicEvent->status != MobileEventStatusEnum::OPEN) {
            throw new \Exception('Evento não aberto para agendamento.');
        }
    }

    private function validateAnimalSpecies($animal, $mobileClinicEvent): void
    {
        if (! in_array($animal->species, $mobileClinicEvent->species->toArray())) {
            throw new \Exception('Espécie do animal não é permitida no evento.');
        }
    }
}
