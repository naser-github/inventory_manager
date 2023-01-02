<?php

namespace App\Http\Requests\Setting\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->id)],
            'password' => ['bail', 'nullable', 'string', 'confirmed', Password::min(8)->mixedCase()->symbols()],
            'status' => ['required', 'boolean'],

            'phone' => ['required', 'regex:/(01)[0-9]{9}$/', Rule::unique('user_profiles')->ignore($this->id, 'user_id')],

            'role' => ['required', 'integer', Rule::exists("roles", "id")],
        ];
    }
}
