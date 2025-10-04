<?php

namespace App\Domains\User\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\User\Entities\UserEntity;
use App\Domains\User\Repositories\UserRepository;
use App\Events\UserCreated;

class UserService extends AbstractService
{
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function afterSave($entity, array $params)
    {
        event(new UserCreated($entity, $params));

        return $entity;
    }

    public function panelConfig($user)
    {
        $address = UserEntity::find($user->id)?->addresses->first();

        $apiKey = env('TIMEZONEDB_API_KEY');
        $latitude = $address?->latitude;
        $longitude = $address?->longitude;
        $response = file_get_contents("http://api.timezonedb.com/v2.1/get-time-zone?key={$apiKey}&format=json&by=position&lat={$latitude}&lng={$longitude}");
        $data = json_decode($response);

        return response()->json([
            'status' => 'success',
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'password' => 'passwordFake',
                'city' => $address?->city,
                'state' => $address?->state,
                'timezone' => $data?->zoneName,
            ],
        ]);
    }
}
