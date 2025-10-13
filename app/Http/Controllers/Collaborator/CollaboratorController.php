<?php

namespace App\Http\Controllers\Collaborator;

use App\Http\Controllers\AbstractController;
use App\Domains\Collaborator\Services\CollaboratorService;
use App\Http\Requests\Collaborator\StoreCollaboratorRequest;


class CollaboratorController extends AbstractController
{
    public $requestValidate = StoreCollaboratorRequest::class;

    public function __construct(CollaboratorService $service)
    {
        $this->service = $service;
    }
}
