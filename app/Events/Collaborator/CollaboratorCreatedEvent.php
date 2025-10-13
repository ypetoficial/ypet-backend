<?php

namespace App\Events\Collaborator;

use App\Domains\Collaborator\Entities\CollaboratorEntity;
use Illuminate\Foundation\Events\Dispatchable;

class CollaboratorCreatedEvent
{
    use Dispatchable;

    public CollaboratorEntity $collaboratorEntity;

    public array $params;

    public function __construct(CollaboratorEntity $collaboratorEntity, array $params = [])
    {
        logger('CollaboratorCreatedEvent event triggered', [$collaboratorEntity, $params]);
        $this->collaboratorEntity = $collaboratorEntity;
        $this->params = $params;
    }
}
