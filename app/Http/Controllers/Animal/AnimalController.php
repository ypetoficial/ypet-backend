<?php

namespace App\Http\Controllers\Animal;

use App\Http\Controllers\AbstractController;
use App\Domains\Animal\Services\AnimalService;


class AnimalController extends AbstractController
{
    public function __construct(AnimalService $service)
    {
        $this->service = $service;
    }
}
