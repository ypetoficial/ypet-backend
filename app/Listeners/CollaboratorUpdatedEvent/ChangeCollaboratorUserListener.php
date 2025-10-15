<?php

namespace App\Listeners\CollaboratorUpdatedEvent;

use App\Domains\Collaborator\Entities\CollaboratorEntity;
use App\Domains\User\Entities\UserEntity;
use App\Domains\User\Services\UserService;
use App\Domains\User\Services\UserStatusService;
use App\Events\Collaborator\CollaboratorUpdatedEvent;

class ChangeCollaboratorUserListener
{

    public function __construct(
        protected readonly UserService $userService,
        protected readonly UserStatusService $userStatusService
    ) {}

    public function handle(CollaboratorUpdatedEvent $event): void
    {
        $entity = $event->collaboratorEntity;
        $params = $event->params;

        logger()->info('ChangeCollaboratorUserListener triggered', [
            'entity_id' => $entity->id,
            'params' => $params,
        ]);

        $user = $this->findUser($entity);

        if (! $user) {
            return;
        }

        $this->updateUserData($user, $params);
        $this->updateUserStatus($user, $params);
        $this->syncUserRole($user, $params);
    }

    private function findUser(CollaboratorEntity $collaboratorEntity)
    {
        $user = $this->userService->find($collaboratorEntity->user_id);
        if (! $user) {
            logger()->warning('User not found for collaborator', [
                'collaborator_id' => $collaboratorEntity->id,
                'user_id' => $collaboratorEntity->user_id,
            ]);

            return null;
        }

        return $user;
    }

    private function updateUserData(UserEntity $user, $params): void
    {
        $this->userService->update($user->id, [
            'name' => data_get($params, 'user_name', $user->name),
            'cellphone' => data_get($params, 'user_cellphone', $user->cellphone),
        ]);
    }

    private function updateUserStatus($user, $params): void
    {
        if (empty($params['user_status'])) {
            return;
        }

        $userStatus = data_get($user, 'user_status');

        $lastStatus = $this->userStatusService->findOneLast([
            'user_id' => $user->id,
        ]);

        if ($lastStatus && data_get($lastStatus->status, 'value') === $userStatus) {
            return;
        }

        $this->userStatusService->save([
            'user_id' => $user->id,
            'status' => data_get($params, 'user_status'),
            'description' => 'Status changed by collaborator update',
            'changed_by' => data_get($params, 'changed_by', null),
        ]);
    }

    private function syncUserRole($user, $params): void
    {
        if (empty($params['user_role'])) {
            return;
        }

        $userRole = data_get($user, 'user_role');

        $user->syncRoles([$userRole]);
    }
}
