<?php

namespace App\Domains\Veterinarian\Services;

use App\Events\UserCreated;
use App\Domains\Abstracts\AbstractService;
use App\Domains\User\Services\UserService;
use App\Domains\Veterinarian\Repositories\VeterinarianRepository;

class VeterinarianService extends AbstractService
{
    public UserService $userService;

    public function __construct(VeterinarianRepository $repository)
    {
        $this->repository = $repository;
        $this->userService = app(UserService::class);
    }

    public function beforeSave(array $data): array
    {
        $data['is_veterinarian'] = true;
        $data['cellphone'] = data_get($data, 'phone');

        $permissions = $data['permissions'] ?? [];
        $data['permissions'] = $permissions;

        $data['user_id'] = $this->userService->save($data)?->id;

        return $data;
    }

    public function beforeUpdate($id, array $data): array
    {
        $veterinarian = $this->find($id);
        $permissions = $data['permissions'] ?? [];
        $data['permissions'] = $permissions;

        $this->userService->update($veterinarian->user_id, $data);

        return $data;
    }
}
