<?php

namespace App\Domains\Veterinarian\Repositories;

use App\Domains\Abstracts\AbstractRepository;
use App\Domains\Veterinarian\Entities\VeterinarianEntity;

class VeterinarianRepository extends AbstractRepository
{
    public function __construct(VeterinarianEntity $model)
    {
        $this->model = $model;
    }
}
