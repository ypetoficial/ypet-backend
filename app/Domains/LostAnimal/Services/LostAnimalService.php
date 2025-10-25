<?php

namespace App\Domains\LostAnimal\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\LostAnimal\Repositories\LostAnimalRepository;
use App\Domains\Address\Repositories\AddressRepository;
use App\Domains\Address\ValueObjects\AddressValueObject;
use App\Domains\Address\ValueObjects\CoordinatesValueObject;
use App\Domains\Enums\LostAnimalStatusEnum;
use App\Domains\LostAnimal\DTOs\StoreLostAnimalDTO;
use App\Domains\LostAnimal\Entities\LostAnimalEntity;
use App\Events\LostAnimalClosed;
use App\Events\LostAnimalCreated;
use App\Events\LostAnimalFound;

class LostAnimalService extends AbstractService
{
    protected $addressRepository;
    protected $lostAnimalStatusService;

    public function __construct(LostAnimalRepository $repository, AddressRepository $addressRepository, LostAnimalStatusService $lostAnimalStatusService)
    {
        $this->repository = $repository;
        $this->addressRepository = $addressRepository;
        $this->lostAnimalStatusService = $lostAnimalStatusService;
    }

    public function afterSave($entity, array $params)
    {
        $this->saveAddress($entity, $params);
        $this->saveLostAnimalStatus($entity, $params);
        $this->sendNotification($entity, $params);

        return $entity;
    }

    private function saveAddress($entity, array $params)
    {
        if (isset($params['address'])) {
            $this->addressRepository->create([
                'addressable_id' => $entity->id,
                'addressable_type' => LostAnimalEntity::class,
                ...$params['address'],
            ]);
        }
    }

    private function saveLostAnimalStatus($entity, array $params)
    {
        $this->lostAnimalStatusService->save([
            'lost_animal_id' => $entity->id,
            'status' => data_get($params, 'status'),
            'created_by' => $entity->created_by,
        ]);
    }

    private function sendNotification($entity, array $params){
        $dto = new StoreLostAnimalDTO(
            animalId: $params['animal_id'],
            createdBy: $entity->created_by,
            lostAt: $params['lost_at'],
            status: $params['status'],
            address: new AddressValueObject(
                addressableId: $entity->id,
                addressableType: LostAnimalEntity::class,
                street: $params['address']['street'],
                number: $params['address']['number'] ?? null,
                complement: $params['address']['complement'] ?? null,
                district: $params['address']['district'] ?? null,
                city: $params['address']['city'] ?? null,
                state: $params['address']['state'] ?? null,
                zipCode: $params['address']['zip_code'] ?? null,
                country: $params['address']['country'] ?? null,
                coordinates: new CoordinatesValueObject(
                    latitude: $params['address']['latitude'],
                    longitude: $params['address']['longitude'],
                ),
            ),
        );

        event(new LostAnimalCreated($entity, $dto));
    }

    public function afterUpdate($entity, array $params)
    {
        if ($entity->wasChanged('status') && $entity->status) {
            $currentStatus = $entity->status->status ?? null;
            $animalName = $entity->animal->name ?? 'Pet';

            if ($currentStatus === 'found') {
                event(new LostAnimalFound($entity->created_by, (string) $entity->id, $animalName));
            }
        }

        return $entity;
    }

    public function markAsFoundByOwner($id)
    {
        $entity = $this->find($id, ['animal']);
        $animalName = $entity->animal->name ?? 'Pet';

        $this->update($id, ['status' => 'found']);

        event(new LostAnimalClosed($entity->created_by, (string) $entity->id, $animalName));

        return $entity;
    }

    public function found($id)
    {
        return $this->lostAnimalStatusService->updateStatus($id, LostAnimalStatusEnum::FOUND);
    }

    public function conclude($id)
    {
        return $this->lostAnimalStatusService->updateStatus($id, LostAnimalStatusEnum::CONCLUDE);
    }
}
