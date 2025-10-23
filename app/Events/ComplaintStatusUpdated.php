<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ComplaintStatusUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $userId;

    public string $complaintId;

    public string $newStatus;

    public function __construct(int $userId, string $complaintId, string $newStatus)
    {
        logger('ComplaintStatusUpdated event triggered', [$userId, $complaintId, $newStatus]);
        $this->userId = $userId;
        $this->complaintId = $complaintId;
        $this->newStatus = $newStatus;
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
