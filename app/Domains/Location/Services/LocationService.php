<?php

namespace App\Domains\Location\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\Location\Repositories\LocationRepository;
use Illuminate\Support\Facades\Auth;

class LocationService extends AbstractService
{
    public function __construct(LocationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function afterSave($entity, array $params)
    {
        $addresses = data_get($params, 'address', []);
        $data = $entity->addresses()->create($addresses);

        return $data;
    }

    public function save(array $data): mixed
    {
        if (Auth::user()->hasRole('user_common')) {
            abort(403, 'Usuário sem permissão.');
        }

        $data = $this->beforeSave($data);
        if ($this->validateOnInsert($data) !== false) {
            $entity = $this->repository->create($data);
            $this->afterSave($entity, $data);

            return $entity;
        }

        throw new \Exception('Não foi possível concluir o cadastro. Tente novamente mais tarde.', 422);
    }
}
