<?php

namespace App\Domains\Collaborator\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\Collaborator\Entities\CollaboratorEntity;

class CollaboratorRepository extends AbstractRepository
{
    public function __construct(CollaboratorEntity $model)
    {
        $this->model = $model;
    }
}
