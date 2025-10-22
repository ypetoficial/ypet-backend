<?php

namespace App\Http\Requests\Report;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            // 'picture' => ['nullable', 'image', 'max:2048'],
            'picture' => ['nullable'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }
}
