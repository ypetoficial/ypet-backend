<?php

namespace App\Domains\Protector\Services;

use App\Enums\AddressTypeEnum;
use Illuminate\Support\Facades\Auth;
use App\Domains\Abstracts\AbstractService;
use App\Domains\Protector\Repositories\ProtectorRepository;

class ProtectorService extends AbstractService
{
    public function __construct(ProtectorRepository $repository)
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
