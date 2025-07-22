<?php

namespace App\Http\Controllers\User;

use App\Domains\User\Services\UserService;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserProfileController extends AbstractController
{
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function me(Request $request)
    {
        try {
            $user = $this->service->find($request->user()->id, $request->get('with', []));

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
        try {
            $user = $request->user();

            $this->service->update($user->id, $request->only(['name', 'telephone', 'cellphone']));

            return $this->ok([
                'message' => 'Perfil atualizado com sucesso.',
                'user' => $user->refresh(),
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
