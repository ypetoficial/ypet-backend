<?php

namespace App\Listeners\UserCreated;

use App\Events\UserCreated;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\Permission\Models\Role;

class AssignRoleListener implements ShouldQueue
{
    use InteractsWithQueue, Queueable;

    /**
     * The role to be assigned.
     */
    protected Role $role;

    /**
     * The tags for the listener.
     */
    public function tags(): array
    {
        return ['AssignRoleListener'];
    }

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        $this->onQueue('user-created');
    }

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
