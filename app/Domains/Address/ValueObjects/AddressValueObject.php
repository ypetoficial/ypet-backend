<?php

namespace App\Domains\Address\ValueObjects;

final readonly class AddressValueObject
{
    public function __construct(
        public int $addressableId,
        public string $addressableType,
        public string $street,
        public ?string $number = null,
        public ?string $complement = null,
        public ?string $district = null,
        public ?string $city = null,
        public ?string $state = null,
        public ?string $zipCode = null,
        public ?string $country = null,
        public ?CoordinatesValueObject $coordinates = null,
    ) {}
}
