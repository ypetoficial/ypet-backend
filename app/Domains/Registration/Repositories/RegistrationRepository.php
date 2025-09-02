<?php

namespace App\Domains\Registration\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\Registration\Entities\RegistrationEntity;

class RegistrationRepository extends AbstractRepository
{
    public function __construct(RegistrationEntity $model)
    {
        $this->model = $model;
    }

    public function all(
        array $params = [],
        array $with = [],
        array $options = [],
    ) {
        $model = $this->getModel();
        $orderByColumn = data_get($options, 'order_by.column', 'id');
        $orderByDirection = data_get($options, 'order_by.direction', 'asc');
        $perPage = data_get($options, 'per_page', 20);
        $columns = data_get($options, 'columns', '*');
        $columns = is_array($columns) ? $columns : explode(',', $columns);

        $params = array_filter(
            $params,
            fn ($key) => in_array($key, $model->getFillable()),
            ARRAY_FILTER_USE_KEY
        );

        $query = $model->with($with)
            ->where($params);

        $query->when(data_get($options, 'tutor_name'), function ($query, $tutorName) {
            $query->whereHas('user', function ($query) use ($tutorName) {
                $query->where('name', 'like', "%{$tutorName}%");
            });
        });

        $query->orderBy($orderByColumn, $orderByDirection)
            ->paginate($perPage, $columns)
            ->withQueryString();

        return $query;
    }
}
