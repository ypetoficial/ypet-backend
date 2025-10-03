<?php

namespace App\Listeners\AnimalCreated;

use App\Domains\Address\Services\AddressService;
use App\Events\AnimalCreated;
use Illuminate\Support\Arr;

readonly class CreateUserAddressListener
{
    public function __construct(
        protected AddressService $addressService
    ) {}

    public function handle(AnimalCreated $event): void
    {
        $entity = $event->entity;
        $params = $event->params;

        logger()->info('CreateUserAddressListener triggered', [
            'entity_id' => $entity->id,
            'params' => $params,
        ]);

        if (Arr::has($params, 'address')) {
            $this->createAddress($entity, Arr::get($params, 'address'));
        }
    }

    private function createAddress($entity, $addressData): void
    {
        $this->addressService->save([
            'addressable_id' => $entity->id,
            'addressable_type' => get_class($entity),
            'street' => Arr::get($addressData, 'street'),
            'number' => Arr::get($addressData, 'number'),
            'complement' => Arr::get($addressData, 'complement'),
            'district' => Arr::get($addressData, 'district'),
            'city' => Arr::get($addressData, 'city'),
            'state' => Arr::get($addressData, 'state'),
            'country' => Arr::get($addressData, 'country', 'BR'),
            'zip_code' => Arr::get($addressData, 'zipcode'),
            'latitude' => Arr::get($addressData, 'latitude'),
            'longitude' => Arr::get($addressData, 'longitude'),
        ]);
    }
}
