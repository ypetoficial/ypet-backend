<?php

namespace App\Domains\EvaluationAnimal\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\Enums\EvaluationAnimalStatusEnum;
use App\Domains\EvaluationAnimal\Entities\EvaluationAnimalStatusEntity;

class EvaluationAnimalStatusRepository extends AbstractRepository
{
    public function __construct(EvaluationAnimalStatusEntity $model)
    {
        $this->model = $model;
    }

    public function all(array $params = [], array $with = [], array $options = [])
    {
        $model = $this->getModel();
        $orderByColumn = data_get($options, 'order_by.column', 'id');
        $orderByDirection = data_get($options, 'order_by.direction', 'asc');
        $perPage = data_get($options, 'per_page', 20);
        $columns = data_get($options, 'columns', '*');
        $columns = is_array($columns) ? $columns : explode(',', $columns);

        $query = $model->with($with);

        array_filter(
            $params,
            fn ($key) => in_array($key, $model->getFillable()),
            ARRAY_FILTER_USE_KEY
        );

        $query->when(! empty($params['status']), function ($q) use ($params) {
            $q->where('status', $params['status']);
        });

        return $query
            ->orderBy($orderByColumn, $orderByDirection)
            ->paginate($perPage, $columns)
            ->withQueryString();
    }

    public function updateStatus(int|string $id, EvaluationAnimalStatusEnum $status)
    {
        $visit = $this->find($id);

        if (! $visit) {
            throw new \Exception('Visita não encontrada');
        }

        $data = [
            'status' => $status->value,
        ];

        $this->update($visit, $data);

        return $visit;
    }
}
