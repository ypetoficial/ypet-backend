<?php

namespace App\Http\Requests\Notification;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|string|in:alerta,lembrete,confirmacao,informativa',
            'action_label' => 'nullable|string|max:255',
            'action_target' => 'nullable|string|max:255',
        ];
    }
}
