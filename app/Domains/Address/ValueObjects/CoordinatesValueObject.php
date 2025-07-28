<?php

namespace App\Domains\Address\ValueObjects;

final readonly class CoordinatesValueObject
{
    public function __construct(
        public float $latitude,
        public float $longitude,
    ) {}
}
