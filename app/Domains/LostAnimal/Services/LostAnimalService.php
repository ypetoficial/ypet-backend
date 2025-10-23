<?php

namespace App\Domains\LostAnimal\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\LostAnimal\Repositories\LostAnimalRepository;
use App\Events\LostAnimalClosed;
use App\Events\LostAnimalCreated;
use App\Events\LostAnimalFound;

class LostAnimalService extends AbstractService
{
    public function __construct(LostAnimalRepository $repository)
    {
        $this->repository = $repository;
    }

    public function afterSave($entity, array $params)
    {
        event(new LostAnimalCreated($entity, $params['dto'] ?? []));

        return $entity;
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
}
