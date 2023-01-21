<?php

namespace App\Http\Requests\Setting\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class VendorStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'unique:vendors'],
            'phone' => ['bail', 'nullable', 'regex:/(01)[0-9]{9}$/', 'unique:vendors,phone_number'],
            'address' => ['bail', 'nullable'],
            'status' => ['required', 'boolean'],
        ];
    }
}
