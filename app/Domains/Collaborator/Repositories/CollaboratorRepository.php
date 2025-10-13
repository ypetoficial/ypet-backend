<?php

namespace App\Domains\Collaborator\Repositories;

use App\Domains\Collaborator\Entities\CollaboratorEntity;
use App\Domains\Abstracts\AbstractRepository;

class CollaboratorRepository extends AbstractRepository
{
    public function __construct(CollaboratorEntity $model)
    {
        $this->model = $model;
    }
}
