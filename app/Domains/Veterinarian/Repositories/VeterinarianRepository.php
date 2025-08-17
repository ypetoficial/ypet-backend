<?php

namespace App\Domains\Veterinarian\Repositories;

use App\Domains\Veterinarian\Entities\VeterinarianEntity;
use App\Domains\Abstracts\AbstractRepository;

class VeterinarianRepository extends AbstractRepository
{
    public function __construct(VeterinarianEntity $model)
    {
        $this->model = $model;
    }
}
