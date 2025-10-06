<?php

namespace App\Domains\Registration\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\Animal\Entities\AnimalEntity;
use App\Domains\Animal\Services\AnimalService;
use App\Domains\Enums\RegistrationStatusEnum;
use App\Domains\MobileClinicEvent\Services\MobileClinicEventService;
use App\Domains\Registration\Repositories\RegistrationRepository;
use App\Domains\User\Entities\UserEntity;
use App\Domains\User\Services\UserService;
use Illuminate\Support\Arr;

class RegistrationService extends AbstractService
{
    public function __construct(
        RegistrationRepository $repository,
        protected readonly AnimalService $animalService,
        protected readonly MobileClinicEventService $mobileClinicEventService,
        protected readonly UserService $userService
    ) {
        $this->repository = $repository;
    }

    /**
     * @throws \Exception
     */
    public function beforeSave(array $data): array
    {
        $tutor = $this->findOrCreateTutor($data);
        Arr::set($data, 'tutor_id', $tutor->id);
        $animal = $this->findOrCreateAnimal($data);
        $mobileClinicEvent = $this->mobileClinicEventService->find(Arr::get($data, 'mobile_clinic_event_id'));

        Arr::set($data, 'mobile_clinic_event_id', Arr::get($data, 'mobile_clinic_event_id'));
        Arr::set($data, 'user_id', $tutor->id);
        Arr::set($data, 'animal_id', $animal->id);
        Arr::set($data, 'status', RegistrationStatusEnum::PENDING);

        $this->validateAnimalRegistration($animal, $tutor);
        $this->validateEventAvailability($mobileClinicEvent);
        $this->validateAnimalSpecies($animal, $mobileClinicEvent);

        return $data;
    }

    /**
     * @throws \InvalidArgumentException
     */
    private function validateAnimalRegistration($animal, $tutor): void
    {
        $existsRegistrationPending = $animal->registrations()
            ->where('status', '=', RegistrationStatusEnum::PENDING)
            ->exists();

        if ($existsRegistrationPending) {
            throw new \InvalidArgumentException('Animal já está cadastrado em um evento');
        }

        logger()->info('Validating animal ownership', [
            'animal_id' => $animal->id,
            'tutor_id' => $tutor->id,
            'check' => [$animal->tutor_id, $tutor->id],
        ]);

        if ($animal->tutor_id != $tutor->id) {
            throw new \InvalidArgumentException('Animal não pertence ao usuário');
        }
    }

    private function validateEventAvailability($mobileClinicEvent): void
    {
        if (! $mobileClinicEvent->isStatusOpen()) {
            throw new \InvalidArgumentException('Evento não aberto para agendamento.');
        }
    }

    private function validateAnimalSpecies($animal, $mobileClinicEvent): void
    {
        $animalSpecies = Arr::get($animal->species, 'value');
        $mobileClinicEventSpecies = Arr::get($mobileClinicEvent->species, 'value');

        if ($mobileClinicEventSpecies !== $animalSpecies) {
            throw new \InvalidArgumentException('Espécie do animal não é permitida no evento.');
        }
    }

    private function findOrCreateAnimal(array $data): AnimalEntity
    {
        $animal_id = Arr::get($data, 'animal_id');

        if ($animal_id) {
            /** @var AnimalEntity $animal */
            $animal = $this->animalService->find($animal_id);

            return $animal;
        }

        $payload = [
            'tutor_id' => Arr::get($data, 'tutor_id'),
            'name' => Arr::get($data, 'animal_name'),
            'species' => Arr::get($data, 'animal_specie'),
            'gender' => Arr::get($data, 'animal_gender'),
            'size' => Arr::get($data, 'animal_size'),
            'color' => Arr::get($data, 'animal_color'),
            'birth_date' => Arr::get($data, 'animal_birth_date'),
            'weight' => Arr::get($data, 'animal_weight'),
            'status' => Arr::get($data, 'animal_status'),
        ];

        /** @var AnimalEntity $animal */
        $animal = $this->animalService->save($payload);

        return $animal;
    }

    /**
     * @throws \Exception
     */
    private function findOrCreateTutor(array $data): mixed
    {
        $tutor_id = Arr::get($data, 'tutor_id');

        if ($tutor_id) {
            /** @var UserEntity $tutor */
            $tutor = $this->userService->find($tutor_id);

            return $tutor;
        }

        $tutor_email = Arr::get($data, 'tutor_email');

        /** @var UserEntity $tutor */
        $existingUser = $this->userService->getAllWithoutPagination(
            ['email' => $tutor_email],
            [],
            ['limit' => 1]
        )->first();

        if ($existingUser) {
            return $existingUser;
        }

        $defaultPassword = Arr::get($data, 'tutor_document');
        $tutorAddress = Arr::get($data, 'tutor_address', []);
        Arr::set($tutorAddress, 'country', Arr::get($tutorAddress, 'country', 'BR'));

        $payload = [
            'name' => Arr::get($data, 'tutor_name'),
            'email' => Arr::get($data, 'tutor_email'),
            'document' => Arr::get($data, 'tutor_document'),
            'cellphone' => Arr::get($data, 'tutor_cellphone'),
            'password' => bcrypt($defaultPassword),
            'address' => $tutorAddress,
        ];

        /** @var UserEntity $tutor */
        $tutor = $this->userService->save($payload);

        return $tutor;
    }
}
