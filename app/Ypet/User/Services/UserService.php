<?php

namespace App\Ypet\User\Services;

use App\Models\User;
use App\Ypet\Abstracts\AbstractService;
use App\Ypet\Common\Enums\UserTypeEnum;
use App\Ypet\User\Repositories\UserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

/**
 * @property UserRepository $repository
 */
class UserService extends AbstractService
{
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param  array  $with
     * @return LengthAwarePaginator
     */
    public function all(array $params = [], $with = [])
    {
        $params['type'] = UserTypeEnum::INTERNAL;

        return parent::all($params, $with);
    }

    public function findByEmail(string $email)
    {
        return $this->repository->findByEmail($email);
    }

    public function beforeSave(array $data): array
    {
        $data['password'] = Hash::make($data['password']);
        $data['type'] = UserTypeEnum::INTERNAL;

        return $data;
    }

    public function afterSave($entity, array $params)
    {
        /** @var User $entity */
        $entity->assignRole($params['role']);

        return parent::afterSave($entity, $params);
    }

    public function beforeUpdate($id, array $data): array
    {
        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        return $data;
    }

    public function afterUpdate($entity, array $params)
    {
        if (isset($params['role'])) {
            /** @var User $entity */
            $entity->syncRoles($params['role']);
        }

        parent::afterUpdate($entity, $params);
    }
}
