<?php

namespace App\Domains\Supplier\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\Address\Repositories\AddressRepository;
use App\Domains\Contact\Repositories\ContactRepository;
use App\Domains\Supplier\Entities\SupplierEntity;
use App\Domains\Supplier\Repositories\SupplierRepository;

class SupplierService extends AbstractService
{
    protected AddressRepository $addressRepository;

    protected ContactRepository $contactRepository;

    public function __construct(
        SupplierRepository $repository,
        AddressRepository $addressRepository,
        ContactRepository $contactRepository)
    {
        $this->repository = $repository;
        $this->addressRepository = $addressRepository;
        $this->contactRepository = $contactRepository;
    }

    public function beforeSave(array $data): array
    {
        return array_merge($data['supplier'], $data);
    }

    public function afterSave($entity, array $params)
    {
        if (isset($params['contact'])) {
            $this->contactRepository->create([
                'contactable_id' => $entity->id,
                'contactable_type' => SupplierEntity::class,
                ...$params['contact'],
            ]);
        }

        if (isset($params['address'])) {
            $this->addressRepository->create([
                'addressable_id' => $entity->id,
                'addressable_type' => SupplierEntity::class,
                ...$params['address'],
            ]);
        }
    }

    public function beforeUpdate($id, array $data): array
    {
        return array_merge($data['supplier'], $data);
    }

    public function afterUpdate($entity, array $params)
    {
        if (isset($params['contact']) && count($entity->contacts)) {
            $this->contactRepository->update($entity->contacts[0], $params['contact']);
        }

        if (isset($params['address']) && count($entity->addresses)) {
            $this->addressRepository->update($entity->addresses[0], $params['address']);
        }
    }
}
