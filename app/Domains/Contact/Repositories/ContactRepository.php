<?php

namespace App\Domains\Contact\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\Contact\Entities\ContactEntity;

class ContactRepository extends AbstractRepository
{
    public function __construct(ContactEntity $model)
    {
        $this->model = $model;
    }
}
