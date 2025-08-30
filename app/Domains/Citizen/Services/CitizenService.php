<?php

namespace App\Domains\Citizen\Services;

use App\Enums\AddressTypeEnum;
use Illuminate\Support\Facades\Auth;
use App\Domains\Abstracts\AbstractService;
use App\Domains\Citizen\Repositories\CitizenRepository;

class CitizenService extends AbstractService
{
    public function __construct(CitizenRepository $repository)
    {
        $this->repository = $repository;
    }

    public function beforeUpdate($id, array $data): array
    {
        $data['updated_by'] =  Auth::user()?->id;

        return $data;
    }

    public function afterSave($entity, array $params)
    {
        $addressData = data_get($params, 'address');
        if (isset($addressData)) {
            $addressData['type'] = AddressTypeEnum::MAIN;
            
            $entity->addresses()->create($addressData);
        }
    }
}
