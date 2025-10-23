<?php

namespace App\Domains\Registration\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\Animal\Entities\AnimalEntity;
use App\Domains\Animal\Services\AnimalService;
use App\Domains\Citizen\Services\CitizenService;
use App\Domains\Enums\AnimalStatusEnum;
use App\Domains\Enums\GenderEnum;
use App\Domains\Enums\RegistrationStatusEnum;
use App\Domains\Enums\UserStatusEnum;
use App\Domains\MobileClinicEvent\Services\MobileClinicEventService;
use App\Domains\Registration\Repositories\RegistrationRepository;
use App\Domains\User\Entities\UserEntity;
use App\Domains\User\Services\UserService;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class RegistrationService extends AbstractService
{
    public function __construct(
        RegistrationRepository $repository,
        protected readonly AnimalService $animalService,
        protected readonly MobileClinicEventService $mobileClinicEventService,
        protected readonly UserService $userService,
        protected readonly CitizenService $citizenService
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
        $this->validateEventAvailability($mobileClinicEvent, $animal);

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

    private function validateEventAvailability($mobileClinicEvent, $animal): void
    {
        if (! $mobileClinicEvent->isStatusOpen()) {
            throw new \InvalidArgumentException('Evento não aberto para agendamento.');
        }

        $rules = $mobileClinicEvent->rules();

        $maxRegistrations = $rules->sum('max_registrations');
        if($mobileClinicEvent->getCurrentRegistrationsAttribute() >= $maxRegistrations) {
            throw new \InvalidArgumentException('Não há mais vagas para o animal');
        }

        $maxRegistrationByGender = $rules->where('gender', $animal->gender['value'])->sum('max_registrations');

        if($mobileClinicEvent->getCurrentRegistrationByGenderAttribute($animal->gender['value']) >= $maxRegistrationByGender) {
            throw new \InvalidArgumentException('Não há mais vagas para o animal do gênero '. $animal->gender['label']);
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
            'entry_date'=> Carbon::now()->format('Y-m-d H:i:s'),
            'status' => AnimalStatusEnum::WITH_OWNER,
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

        if(empty($tutorAddress)) {
            $tutorAddress = [
                'zip_code' => Arr::get($data, 'tutor_address_zip_code'),
                'street' => Arr::get($data, 'tutor_address_street'),
                'number' => Arr::get($data, 'tutor_address_number'),
                'district' => Arr::get($data, 'tutor_address_district'),
                'city' => Arr::get($data, 'tutor_address_city'),
                'state' => Arr::get($data, 'tutor_address_state'),
                'complement' => Arr::get($data, 'tutor_address_complement'),
            ];
        }

        Arr::set($tutorAddress, 'country', Arr::get($tutorAddress, 'country', 'BR'));

        $payload = [
            'name' => Arr::get($data, 'tutor_name'),
            'email' => Arr::get($data, 'tutor_email'),
            'document' => Arr::get($data, 'tutor_document'),
            'telephone' => Arr::get($data, 'tutor_cellphone'),
            'password' => bcrypt($defaultPassword),
            'gender' => 'N/A',
            'special_permissions' => false,
            'can_report_abuse' => false,
            'can_mobile_castration' => false,
            'status' => UserStatusEnum::ACTIVE,
            'address' => [$tutorAddress],
        ];

        /** @var UserEntity $tutor */
        $tutor = $this->citizenService->save($payload)?->user;

        return $tutor;
    }
}
