<?php

namespace App\Ypet\Abstracts\Interface;

interface RepositoryInterface
{
    public function getModel();

    public function all(?array $params = []);

    public function find($id);

    public function create(array $data);

    public function firstOrCreate(array $searchParams, array $params);

    public function update($id, array $data);

    public function updateOrCreate(array $paramsValidation, array $data);

    public function delete($id);

    public function getFillable(): array;

    public function findOneWhere(array $where, $with = []);

    public function exists(array $params): bool;

    public function findWhereIn(string $column, array $values, array $with = []);
}
