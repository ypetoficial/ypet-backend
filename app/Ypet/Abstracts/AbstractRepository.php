<?php

namespace App\Ypet\Abstracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Ypet\Abstracts\Interface\RepositoryInterface;

class AbstractRepository implements RepositoryInterface
{
    protected Model $model;

    public function getModel(): Model
    {
        return $this->model;
    }

    public function all(?array $params = [], array $with = []): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $params = $params ?? [];
        $query = $this->model->query();

        $page = $params['page'] ?? 1;
        $perPage = $params['per_page'] ?? $this->model->getPerPage();
        $orderBy = $params['order_by'] ?? 'created_at';
        $orderDirection = $params['order_direction'] ?? 'desc';

        // Remove pagination and ordering params to not interfere with where clauses
        unset($params['page'], $params['per_page'], $params['order_by'], $params['order_direction']);

        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $query->where($key, $value);
            }
        }

        return $query->with($with)
            ->orderBy($orderBy, $orderDirection)
            ->paginate($perPage, ['*'], 'page', $page);
    }

    public function find($id, $with = [])
    {
        if (is_numeric($id)) {
            return $this->model->with($with)->find($id);
        }

        return $this->findOneWhere(['hash' => $id], $with);
    }

    public function findOrFail($id): Model|Builder
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Retorna o primeiro registro encontrado
     *
     * @return mixed
     */
    public function findOneWhere(array $where, $with = [])
    {
        $object = $this->where($where, $with);

        return $object->first();
    }

    public function findWhereIn(string $column, array $values, array $with = [])
    {
        return $this->getModel()->whereIn($column, $values)->with($with)->get();
    }

    /**
     * @param  array  $with
     * @return mixed
     */
    public function where(array $where, $with = [])
    {
        return $this->getModel()->where($where)->with($with)->get();
    }

    public function create(array $data): Model|Builder
    {
        return $this->model->query()->create($data);
    }

    public function update($id, array $data)
    {
        $instanceOfModel = $this->find($id);

        if ($instanceOfModel) {
            $instanceOfModel->update($data);

            return $instanceOfModel;
        }

        return false;
    }

    public function delete($id): bool
    {
        $instanceOfModel = $this->find($id);

        if ($instanceOfModel) {
            $instanceOfModel->delete();

            return true;
        }

        return false;
    }

    public function exists(array $params): bool
    {
        return $this->where($params)->isNotEmpty();
    }

    /**
     * Update or create.
     */
    public function updateOrCreate(array $paramsValidation, array $params): Model
    {
        return $this->getModel()->updateOrCreate($paramsValidation, $params);
    }

    /**
     * First or create.
     */
    public function firstOrCreate(array $searchParams, array $params): Model
    {
        return $this->getModel()->firstOrCreate($searchParams, $params);
    }

    public function getFillable(): array
    {
        return $this->model->getFillable();
    }

    public function findByEmail(string $email)
    {
        return $this->findOneWhere(['email' => $email]);
    }
}
