<?php

namespace App\Events;

use App\Domains\User\Entities\UserEntity;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public UserEntity $userEntity;

    public array $params;

    public function __construct(UserEntity $userEntity, array $params = [])
    {
        logger('UserCreated event triggered', [$userEntity, $params]);
        $this->userEntity = $userEntity;
        $this->params = $params;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
