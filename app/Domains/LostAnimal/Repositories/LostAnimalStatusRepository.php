<?php

namespace App\Domains\LostAnimal\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\Enums\LostAnimalStatusEnum;
use App\Domains\LostAnimal\Entities\LostAnimalStatusEntity;

class LostAnimalStatusRepository extends AbstractRepository
{
    public function __construct(LostAnimalStatusEntity $model)
    {
        $this->model = $model;
    }

    public function updateStatus(int|string $id, LostAnimalStatusEnum $status)
    {

        $animal = $this->findOneWhere(['lost_animal_id' => $id]);

        if (! $animal) {
            throw new \Exception('animal não encontrada');
        }

        $data = [
            'status' => $status->value,
        ];

        $this->update($animal, $data);

        return $animal;
    }
}
