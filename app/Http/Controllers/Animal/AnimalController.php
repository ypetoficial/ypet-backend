<?php

namespace App\Http\Controllers\Animal;

use App\Domains\Animal\Services\AnimalService;
use App\Http\Controllers\AbstractController;

class AnimalController extends AbstractController
{
    public function __construct(AnimalService $service)
    {
        $this->service = $service;
    }
}
