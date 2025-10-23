<?php

namespace App\Domains\Address\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\Address\Repositories\AddressRepository;
use App\Models\Address;

class AddressService extends AbstractService
{
    public function __construct(AddressRepository $addressRepository)
    {
        $this->repository = $addressRepository;
    }

    public function beforeSave(array $data): array
    {
        if (isset($data['cep'],  $data['city_code'])) {
            $data['cep'] = $this->onlyNumbers($data['cep']);
            $data['city_code'] = $this->getCityCode($data['city'], $data['state']);
        }

        return $data;
    }

    public function onlyNumbers(string $value): string
    {
        return preg_replace('/\D/', '', $value);
    }

    public function beforeUpdate($id, array $data): array
    {
        $data['cep'] = $this->onlyNumbers($data['cep']);
        $data['city_code'] = $this->getCityCode($data['city'], $data['state']);

        return $data;
    }

    public function getCityCode(string $city, string $state): ?int
    {
        $city = Address::where('city', $city)
            ->where('state', $state)
            ->pluck('id')
            ->first();

        if ($city) {
            return $city;
        }

        return null;
    }
}
