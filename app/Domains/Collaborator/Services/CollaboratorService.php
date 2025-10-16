<?php

namespace App\Domains\Collaborator\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\Collaborator\Repositories\CollaboratorRepository;
use App\Domains\User\Entities\UserEntity;
use App\Domains\User\Services\UserService;
use App\Events\Collaborator\CollaboratorCreatedEvent;
use App\Events\Collaborator\CollaboratorUpdatedEvent;

class CollaboratorService extends AbstractService
{
    public function __construct(CollaboratorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function beforeSave(array $data): array
    {
        $user = $this->findOrCreateUser($data);
        data_set($data, 'user_id', $user->id);

        return $data;
    }

    public function afterSave($entity, array $params)
    {
        event(new CollaboratorCreatedEvent($entity, $params));

        return $entity;
    }

    public function afterUpdate($entity, array $params)
    {
        event(new CollaboratorUpdatedEvent($entity, $params));
    }

    private function findOrCreateUser(array $data): UserEntity
    {
        $userService = app(UserService::class);

        $user = $userService->findByEmail(data_get($data, 'user_email'));

        if (! $user) {
            $user_document = data_get($data, 'user_document');
            $userData = [
                'name' => data_get($data, 'user_name'),
                'email' => data_get($data, 'user_email'),
                'document' => $user_document,
                'password' => data_get($data, 'user_password', bcrypt($user_document)),
                'cellphone' => data_get($data, 'user_cellphone', ''),
                'status' => data_get($data, 'user_status'),
                'roles' => [
                    data_get($data, 'user_role'),
                ],
                'created_by' => data_get($data, 'created_by', null),
            ];

            /** @var UserEntity $user */
            $user = $userService->save($userData);
        }

        return $user;
    }
}
