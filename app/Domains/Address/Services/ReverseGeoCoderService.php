<?php

namespace App\Domains\Address\Services;

use Illuminate\Support\Facades\Http;

class ReverseGeoCoderService
{
    public function reverseGeoCode($latitude, $longitude)
    {
        $baseUri = 'https://nominatim.openstreetmap.org/reverse';

        $response = Http::withHeaders([
            'User-Agent' => 'Ypet/1.0',
            'accept-language' => 'pt-BR',
        ])->get($baseUri, [
            'lat' => $latitude,
            'lon' => $longitude,
            'format' => 'jsonv2',
            'addressdetails' => 1,
            'zoom' => 18,
        ])
            ->throw()
            ->json();

        return $response['address'] ?? [];
    }

    public function saveTheReversedAddress(array $rawAddress, string $addressableType, int $addressableId)
    {
        $addressService = app(AddressService::class);

        $neighbourhood = $rawAddress['neighbourhood']
                ?? $rawAddress['suburb']
                ?? $rawAddress['city_district']
                ?? $rawAddress['quarter']
                ?? null;

        $address = [
            'addressable_id' => $addressableId,
            'addressable_type' => $addressableType,
            'street' => data_get($rawAddress, 'road'),
            'number' => data_get($rawAddress, 'house_number'),
            'district' => $neighbourhood,
            'city' => data_get($rawAddress, 'city'),
            'state' => data_get($rawAddress, 'state'),
            'zip_code' => data_get($rawAddress, 'postcode'),
            'country' => data_get($rawAddress, 'country'),
        ];

        return $addressService->save($address) ?: false;
    }
}
