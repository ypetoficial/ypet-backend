<?php

namespace App\Domains\Animal\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\Animal\Repositories\AnimalRepository;
use App\Events\AnimalCreated;
use Illuminate\Support\Facades\Log;

class AnimalService extends AbstractService
{
    public function __construct(AnimalRepository $repository)
    {
        $this->repository = $repository;
    }

    public function afterSave($entity, array $params)
    {
        event(new AnimalCreated($entity, $params));

        return $entity;
    }

    public function afterUpdate($entity, array $params)
    {
        $animalEntryDataService = app(AnimalEntryDataService::class);

        if ($this->checkFieldsExistence($params)) {
            Log::info('AnimalService afterUpdate - Modified fields', [
                'modified_data' => $params,
            ]);
            $animalEntryDataService->update($entity->entryData->id, $params);
        } else {
            Log::info('AnimalService afterUpdate - No entry data fields were modified');
        }

        return $entity;
    }

    private function checkFieldsExistence(array $params): bool
    {
        $fields = [
            'registration_number',
            'microchip_number',
            'entry_date',
            'castrated',
            'castration_at',
            'castration_site',
            'dewormed',
            'infirmity',
            'origin',
            'collection_site',
            'collection_reason',
        ];

        foreach ($fields as $field) {
            if (array_key_exists($field, $params) && ! is_null($params[$field])) {
                return true;
            }
        }

        return false;
    }
}
