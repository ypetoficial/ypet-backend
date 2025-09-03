<?php

namespace App\Domains\Protector\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\Protector\Repositories\ProtectorRepository;
use App\Domains\User\Services\UserService;
use App\Enums\AddressTypeEnum;
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

    public function afterSave($entity, array $params)
    {
        $addressData = data_get($params, 'address');
        if (isset($addressData)) {
            $addressData['type'] = AddressTypeEnum::MAIN;

            $entity->addresses()->create($addressData);
        }
    }
}
