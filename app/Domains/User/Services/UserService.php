<?php

namespace App\Domains\User\Services;

use App\Domains\Abstracts\AbstractService;
use App\Domains\Files\FilesService;
use App\Domains\User\Entities\UserEntity;
use App\Domains\User\Repositories\UserRepository;
use App\Events\UserCreated;

class UserService extends AbstractService
{
    const PHOTO_PATH = 'users/';

    public FilesService $filesService;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
        $this->filesService = app(FilesService::class);
    }

    public function beforeSave(array $data): array
    {
        if (data_get($data, 'photo')) {
            $data['photo_url'] = $this->filesService->processImage($data['photo'], self::PHOTO_PATH);
            unset($data['photo']);
        }

        return $data;
    }

    public function afterSave($entity, array $params)
    {
        event(new UserCreated($entity, $params));

        return $entity;
    }

    public function beforeUpdate($id, array $data): array
    {
        if (data_get($data, 'photo')) {
            $user = $this->find($id);
            $this->filesService->delete($user->photo_url);
            $data['photo_url'] = $this->filesService->processImage($data['photo'], self::PHOTO_PATH);
            unset($data['photo']);
        }

        return $data;
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

    public function findByEmail(string $email): ?UserEntity
    {
        /** @var UserEntity $user */
        $user = $this->repository->findOneWhere([
            'email' => $email,
        ]);

        return $user;
    }
}
