<?php

namespace App\Domains\Protector\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\Enums\AddressTypeEnum;
use App\Domains\Protector\Repositories\ProtectorRepository;
use App\Domains\User\Services\UserService;
use Illuminate\Support\Facades\Auth;

class ProtectorService extends AbstractService
{
    public UserService $userService;

    public function __construct(ProtectorRepository $repository)
    {
        $this->repository = $repository;
        $this->userService = app(UserService::class);
    }

    public function beforeSave(array $data): array
    {
        $permissions = $data['permissions'] ?? [];
        $data['permissions'] = $permissions;

        $data['user_id'] = $this->userService->save($data)?->id;

        return $data;
    }

    public function beforeUpdate($id, array $data): array
    {
        $data['updated_by'] = Auth::user()?->id;
        $protector = $this->find($id);
        $permissions = $data['permissions'] ?? [];
        $data['permissions'] = $permissions;

        $this->userService->update($protector->user_id, $data);

        return $data;
    }

    public function afterUpdate($entity, array $params)
    {
        $addresses = data_get($params, 'address', []);
        foreach ($addresses as $addressData) {
            $entity->addresses()->update($addressData);
        }
    }

    public function afterSave($entity, array $params)
    {

        $addresses = data_get($params, 'address', []);
        foreach ($addresses as $addressData) {
            $addressData['type'] = AddressTypeEnum::MAIN;
            $entity->addresses()->create($addressData);
        }
    }
}
