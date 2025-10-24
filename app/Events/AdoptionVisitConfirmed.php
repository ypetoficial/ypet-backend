<?php

namespace App\Events;

use App\Domains\AdoptionVisit\Entities\AdoptionVisitEntity;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AdoptionVisitConfirmed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public AdoptionVisitEntity $adoptionVisit;

    public function __construct(AdoptionVisitEntity $adoptionVisit)
    {
        logger('AdoptionVisitConfirmed event triggered', [$adoptionVisit]);
        $this->adoptionVisit = $adoptionVisit;
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
