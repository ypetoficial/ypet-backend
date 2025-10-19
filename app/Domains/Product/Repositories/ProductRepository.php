<?php

namespace App\Domains\Product\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\Product\Entities\ProductEntity;

class ProductRepository extends AbstractRepository
{
    public function __construct(ProductEntity $model)
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

        $query = $model->with($with)->where($params);

        $query->when(data_get($options, 'name'), function ($q, $name) {
            $q->where('name', 'like', "%{$name}%");
        });

        $query->when(data_get($options, 'category'), function ($q, $category) {
            $q->where('category', $category);
        });

        $query->when(data_get($options, 'status') !== null, function ($q, $status) {
            $q->where('status', (bool) $status);
        });

        return $query->orderBy($orderByColumn, $orderByDirection)
            ->paginate($perPage, $columns)
            ->withQueryString();
    }
}
