<?php

namespace App\Domains\Animal\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\Animal\Repositories\AnimalRepository;
use App\Domains\Enums\AnimalStatusEnum;
use App\Domains\Enums\EvaluationAnimalStatusEnum;
use App\Domains\EvaluationAnimal\Services\EvaluationAnimalStatusService;
use App\Domains\Files\FilesService;
use App\Domains\LostAnimal\Services\LostAnimalService;
use App\Events\AnimalAvailableForAdoption;
use App\Events\AnimalCreated;
use Illuminate\Support\Facades\Log;

class AnimalService extends AbstractService
{
    public FilesService $filesService;

    public EvaluationAnimalStatusService $evaluationAnimalStatusService;

    public LostAnimalService $lostAnimalService;

    public function __construct(AnimalRepository $repository)
    {
        $this->repository = $repository;
        $this->filesService = app(FilesService::class);
        $this->evaluationAnimalStatusService = app(EvaluationAnimalStatusService::class);
        $this->lostAnimalService = app(LostAnimalService::class);
    }

    public function beforeSave(array $data): array
    {

        if (data_get($data, 'picture')) {
            $data['picture'] = $this->filesService->processImage($data['picture']);
        }

        return $data;
    }

    public function afterSave($entity, array $params)
    {

        event(new AnimalCreated($entity, $params));

        $this->createEvaluationAnimal($entity, $params);
        $this->createLostAnimal($entity, $params);

        return $entity;
    }

    public function beforeUpdate($id, array $data): array
    {
        if (data_get($data, 'picture')) {
            $this->filesService->delete($this->find($id)->picture);
            $data['picture'] = $this->filesService->processImage($data['picture']);
        }

        return $data;
    }

    public function afterUpdate($entity, array $params)
    {
        $animalEntryDataService = app(AnimalEntryDataService::class);

        if ($entity->wasChanged('status') && $entity->status === AnimalStatusEnum::FOR_ADOPTION) {
            event(new AnimalAvailableForAdoption($entity->id, $entity->name, $entity->type));
        }

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

    private function createEvaluationAnimal($entity, array $params)
    {

        if ($params['status'] === AnimalStatusEnum::FOR_ADOPTION->value) {
            $this->evaluationAnimalStatusService->save([
                'animal_id' => $entity->id,
                'status' => EvaluationAnimalStatusEnum::PENDING->value,
                'tutor_id' => $params['tutor_id'],
            ]);
        }
    }

    private function createLostAnimal($entity, array $params)
    {

        if ($params['status'] === AnimalStatusEnum::LOST->value) {
            $this->lostAnimalService->save([
                'animal_id' => $entity->id,
                'status' => AnimalStatusEnum::LOST->value,
                'created_by' => $params['tutor_id'],
                'lost_at' => $params['entry_date'],
            ]);
        }
    }
}
