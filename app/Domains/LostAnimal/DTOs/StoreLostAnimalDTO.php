<?php

namespace App\Domains\LostAnimal\DTOs;

use App\Domains\Address\ValueObjects\AddressValueObject;

final class StoreLostAnimalDTO
{
    public function __construct(
        public readonly int $animalId,
        public readonly int $createdBy,
        public readonly string $lostAt,
        public ?AddressValueObject $address,
        public string $status,
    ) {}
}
