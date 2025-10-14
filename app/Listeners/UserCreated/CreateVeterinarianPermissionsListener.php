<?php

namespace App\Listeners\UserCreated;

use App\Events\UserCreated;
use Spatie\Permission\Models\Permission;

class CreateVeterinarianPermissionsListener
{
    public function handle(UserCreated $event): void
    {
        $entity = $event->userEntity;
        $params = $event->params;

        if (! isset($params['is_veterinarian']) || ! $params['is_veterinarian']) {
            return;
        }

        logger()->info('CreateVeterinarianPermissionsListener triggered', [
            'user_id' => $entity->id,
            'params' => $params,
        ]);

        $permissions = $params['permissions'] ?? [];

        $availablePermissions = [
            'can_access_castromovel',
            'can_apply_vaccine',
        ];

        foreach ($availablePermissions as $permissionName) {
            $shouldHavePermission = isset($permissions[$permissionName]) && $permissions[$permissionName] === true;

            $permission = Permission::firstOrCreate([
                'name' => $permissionName,
                'guard_name' => 'web',
            ]);

            if ($shouldHavePermission) {
                if (! $entity->hasPermissionTo($permission)) {
                    $entity->givePermissionTo($permission);

                    logger()->info('Permission assigned to veterinarian', [
                        'user_id' => $entity->id,
                        'permission' => $permissionName,
                    ]);
                }
            } else {
                if ($entity->hasPermissionTo($permission)) {
                    $entity->revokePermissionTo($permission);

                    logger()->info('Permission revoked from veterinarian', [
                        'user_id' => $entity->id,
                        'permission' => $permissionName,
                    ]);
                }
            }
        }
    }
}
