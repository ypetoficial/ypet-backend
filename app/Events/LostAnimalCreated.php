<?php

namespace App\Events;

use App\Domains\LostAnimal\DTOs\StoreLostAnimalDTO;
use App\Domains\LostAnimal\Entities\LostAnimalEntity;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LostAnimalCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public readonly LostAnimalEntity $lostAnimalEntity,
        public readonly StoreLostAnimalDTO $createLostAnimalDTO,
    ) {}

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
