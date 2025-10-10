<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Domains\User\Services\UserService;
use App\Http\Controllers\AbstractController;
use Illuminate\Validation\ValidationException;
use App\Domains\Citizen\Entities\CitizenEntity;
use App\Domains\Citizen\Services\CitizenService;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Domains\Protector\Entities\ProtectorEntity;
use App\Domains\Protector\Services\ProtectorService;

class UserProfileController extends AbstractController
{
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function me(Request $request)
    {
        try {
            $with = array_merge($request->get('with', []), ['citizen', 'protector', 'citizen.addresses', 'protector.addresses']);
            $user = $this->service->find($request->user()->id, $with);

            $typeUser = match (true) {
                $user->citizen !== null => 'citizen',
                $user->protector !== null => 'protector',
                default => null,
            };

            if($typeUser) {
                $user->typeUser = $typeUser;
            }

            return $this->ok([
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            report($e);

            return $this->error('Erro ao obter os dados do usuário.', [], $e->getCode() ?: 500);
        }
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $protectorService = app(ProtectorService::class);
        $citizenService = app(CitizenService::class);
        try {
            $user = $this->service->find($request->user()->id, ['citizen', 'protector']);

            $validated = $request->validated();
            $type = $validated['type'] ?? 'user';

            if ($type === 'citizen') {
                $citizenId = $user->citizen?->id;
                if (! $citizenId) {
                    return $this->error('Usuário não possui perfil de cidadão.', [], 422);
                }
                $citizenService->update($citizenId, $validated);
            } elseif ($type === 'protector') {
                $protectorId = $user->protector?->id;
                if (! $protectorId) {
                    return $this->error('Usuário não possui perfil de protetor.', [], 422);
                }
                $protectorService->update($protectorId, $validated);
            } else {
                $this->service->update($user->id, $validated);
            }

            // Retornar usuário atualizado com relacionamentos relevantes
            $with = array_merge($request->get('with', []), ['citizen', 'protector', 'citizen.addresses', 'protector.addresses']);
            $freshUser = $this->service->find($user->id, $with);

            return $this->ok([
                'message' => 'Perfil atualizado com sucesso.',
                'user' => $freshUser,
            ]);
        } catch (\Exception $e) {
            report($e);

            return $this->error('Erro ao atualizar o perfil.', [], 500);
        }
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $user = $request->user();

            if (! Hash::check($request->current_password, $user->password)) {
                throw ValidationException::withMessages([
                    'current_password' => ['A senha atual está incorreta.'],
                ]);
            }

            $this->service->update($user->id, ['password' => Hash::make($request->password)]);

            return $this->ok([
                'message' => 'Senha atualizada com sucesso.',
            ]);
        } catch (\Exception $e) {
            report($e);

            return $this->error('Erro ao atualizar a senha.', [], 500);
        }
    }
}
