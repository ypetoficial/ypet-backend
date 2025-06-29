<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Ypet\Common\Enums\UserTypeEnum;
use App\Ypet\User\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends AbstractController
{
    public function __construct(UserService $userService)
    {
        $this->service = $userService;
        $this->requestValidate = StoreUserRequest::class;
        $this->requestValidateUpdate = UpdateUserRequest::class;
    }


    public function show($id, Request $request): JsonResponse
    {
        $user = $this->service->find($id);

        if ($user->type !== UserTypeEnum::INTERNAL) {
            abort(404);
        }

        return parent::show($id, $request);
    }

    public function store(Request $request): JsonResponse
    {
        $response = parent::store($request);

        if ($response->getStatusCode() !== 200) {
            return $response;
        }

        $data = json_decode($response->getContent(), true);

        return response()->json($data['response'], 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $user = $this->service->find($id);

        if ($user->type !== UserTypeEnum::INTERNAL) {
            abort(404);
        }

        parent::update($request, $id);

        return response()->json($user->fresh());
    }

    public function destroy($id): JsonResponse
    {
        $user = $this->service->find($id);

        if ($user->type !== UserTypeEnum::INTERNAL) {
            abort(404);
        }

        parent::destroy($id);

        return response()->json(null, 204);
    }
}
