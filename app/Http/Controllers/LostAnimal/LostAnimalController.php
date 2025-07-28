<?php

namespace App\Http\Controllers\LostAnimal;

use App\Domains\LostAnimal\Services\LostAnimalService;
use App\Http\Controllers\AbstractController;

class LostAnimalController extends AbstractController
{
    public function __construct(LostAnimalService $service)
    {
        $this->service = $service;
    }
}
