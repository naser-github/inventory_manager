<?php

namespace App\Http\Requests\Setting\Vendor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VendorUpdateRequest extends FormRequest
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
            'id' => ['required', 'integer'],
            'name' => ['required', 'string', Rule::unique('vendors')->ignore($this->id)],
            'phone' => ['bail', 'nullable', 'regex:/(01)[0-9]{9}$/'],
            'address' => ['bail', 'nullable'],
            'status' => ['required', 'boolean'],
        ];
    }
}
