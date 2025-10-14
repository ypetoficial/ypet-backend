<?php

namespace App\Listeners\UserCreated;

use App\Events\UserCreated;
use Spatie\Permission\Models\Role;

class AssignRoleListener
{
    /**
     * The role to be assigned.
     */
    protected Role $role;

    /**
     * Handle the event.
     */
    public function handle(UserCreated $event): void
    {
        $entity = $event->userEntity;
        $roles = data_get($event->params, 'roles', []);

        logger()->info('AssignRoleListener triggered', [
            'entity_id' => $entity->id,
            'params' => $event->params,
        ]);

        if (empty($roles)) {
            return;
        }

        $entity->assignRole($roles);
        logger()->info('Role assigned to user', [
            'user_id' => $entity->id,
            'role' => $this->role->name,
        ]);
    }
}
