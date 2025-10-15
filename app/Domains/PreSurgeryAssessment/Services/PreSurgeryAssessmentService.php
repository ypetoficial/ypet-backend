<?php

namespace App\Domains\PreSurgeryAssessment\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\Animal\Services\AnimalService;
use App\Domains\PreSurgeryAssessment\Repositories\PreSurgeryAssessmentRepository;

class PreSurgeryAssessmentService extends AbstractService
{
    public function __construct(PreSurgeryAssessmentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function beforeSave(array $data): array
    {
        if (isset($data['animal_data'])) {
            $this->updateAnimalData($data['animal_id'], $data['animal_data']);
        }

        return $data;
    }

    /** Atualiza os dados do animal caso seja editado na triagem */
    private function updateAnimalData(int $animalId, array $data): void
    {
        $animalService = app(AnimalService::class);
        $dataToSave = [];

        foreach ($data as $animalData) {
            if (empty($animalData)) {
                continue;
            }

            $dataToSave[] = $animalData;
        }

        $animalService->update($animalId, $dataToSave);
    }
}
