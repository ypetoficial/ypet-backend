<?php

namespace App\Domains\Citizen\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\Citizen\Repositories\CitizenRepository;
use App\Domains\User\Services\UserService;
use App\Enums\AddressTypeEnum;
use Illuminate\Support\Facades\Auth;

class CitizenService extends AbstractService
{
    public UserService $userService;

    public function __construct(CitizenRepository $repository)
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
        $citizen = $this->find($id);
        $permissions = $data['permissions'] ?? [];
        $data['permissions'] = $permissions;

        $this->userService->update($citizen->user_id, $data);

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
