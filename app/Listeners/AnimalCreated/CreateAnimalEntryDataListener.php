<?php

namespace App\Listeners\AnimalCreated;

use App\Domains\Animal\Services\AnimalEntryDataService;
use App\Events\AnimalCreated;

class CreateAnimalEntryDataListener
{
    public function __construct(
        protected readonly AnimalEntryDataService $animalEntryDataService
    ) {}

    public function handle(AnimalCreated $event): void
    {
        $entity = $event->entity;
        $params = $event->params;
        logger()->info('CreateAnimalEntryDataListener triggered', [
            'entity_id' => $entity->id,
            'params' => $params,
        ]);

        if (empty($params)) {
            logger()->info('No params provided, skipping AnimalEntryData creation');
            return;
        }

        if (!$this->checkFieldsExistence($params)) {
            logger()->info('No relevant fields provided in params, skipping AnimalEntryData creation');
            return;
        }

        $this->animalEntryDataService->save([
            'animal_id' => $entity->id,
            'registration_number' => data_get($params, 'registration_number'),
            'microchip_number' => data_get($params, 'microchip_number'),
            'entry_date' => data_get($params, 'entry_date'),
            'castrated' => data_get($params, 'castrated'),
            'castration_at' => data_get($params, 'castration_at'),
            'castration_site' => data_get($params, 'castration_site'),
            'dewormed' => data_get($params, 'dewormed'),
            'infirmity' => data_get($params, 'infirmity'),
            'origin' => data_get($params, 'origin'),
            'collection_site' => data_get($params, 'collection_site'),
            'collection_reason' => data_get($params, 'collection_reason'),
        ]);
    }

    public function checkFieldsExistence(array $params): bool
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
            if (array_key_exists($field, $params) && !is_null($params[$field])) {
                return true;
            }
        }

        return false;
    }
}
