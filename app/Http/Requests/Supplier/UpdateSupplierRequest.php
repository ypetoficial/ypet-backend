<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'supplier' => ['array'],
            'supplier.legal_name' => ['required', 'string', 'max:255'],
            'supplier.business_name' => ['required', 'string', 'max:255'],
            'supplier.document' => ['required', 'string', 'size:14'],
            'supplier.municipal_registration' => ['nullable', 'string', 'max:255'],
            'supplier.state_registration' => ['nullable', 'string', 'max:255'],
            'supplier.representative' => ['required', 'string', 'max:255'],
            'contact' => ['array'],
            'contact.email' => ['required', 'email', 'max:255'],
            'contact.telephone' => ['required', 'string', 'max:11'],
            'contact.cellphone' => ['required', 'string', 'max:11'],
            'address' => ['array'],
            'address.zip_code' => ['required', 'string', 'max:10'],
            'address.street' => ['required', 'string', 'max:255'],
            'address.number' => ['required', 'string', 'max:20'],
            'address.complement' => ['nullable', 'string', 'max:255'],
            'address.district' => ['required', 'string', 'max:255'],
            'address.city' => ['required', 'string', 'max:255'],
            'address.state' => ['required', 'string', 'max:255'],
            'address.country' => ['nullable', 'string', 'max:255'],
        ];
    }
}
