<?php

namespace App\Http\Controllers\Collaborator;

use App\Domains\Collaborator\Services\CollaboratorService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\Collaborator\StoreCollaboratorRequest;
use App\Http\Requests\Collaborator\UpdateCollaboratorRequest;

class CollaboratorController extends AbstractController
{
    public $requestValidate = StoreCollaboratorRequest::class;

    public $requestValidateUpdate = UpdateCollaboratorRequest::class;

    public function __construct(CollaboratorService $service)
    {
        $this->service = $service;
    }
}
