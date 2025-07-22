<?php

namespace App\Listeners\UserCreated;

use App\Domains\User\Services\UserStatusService;
use App\Events\UserCreated;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateUserStatusListener implements ShouldQueue
{
    use InteractsWithQueue, Queueable;

    public function tags(): array
    {
        return [
            'CreateUserStatusListener',
        ];
    }

    public function __construct(
        protected readonly UserStatusService $userStatusService
    ) {
        $this->onQueue('user-created');
    }

    /**
     * Handle the event.
     */
    public function handle(UserCreated $event): void
    {
        $userEntity = $event->userEntity;
        $params = $event->params;
        logger()->info('CreateUserStatusListener triggered', [
            'entity_id' => $userEntity->id,
            'params' => $params,
        ]);

        $this->userStatusService->save([
            'user_id' => $userEntity->id,
            'status' => $params['status'] ?? 'active',
            'description' => $params['description'] ?? 'User created',
            'created_by' => $params['created_by'] ?? null,
        ]);
    }
}
