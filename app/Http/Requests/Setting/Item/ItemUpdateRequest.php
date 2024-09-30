<?php

namespace App\Http\Requests\Setting\Item;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItemUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', Rule::unique('items')->ignore($this->id)],
            'unit_name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'boolean'],
            'master_category' => ['required', 'integer', Rule::exists("master_categories", "id")],
            'level_one_category' => ['required', 'integer', Rule::exists("level_one_categories", "id")],
//            'level_two_category' => ['required', 'integer', Rule::exists("level_two_categories", "id")],
        ];
    }
}
