<?php

namespace App\Http\Requests\Setting\Category\LevelTwoCategory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LevelTwoCategoryUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', Rule::unique('level_two_categories')->ignore($this->id)],
            'status' => ['required', 'boolean'],
            'master_category' => ['required', 'integer', Rule::exists("master_categories", "id")],
            'level_one_category' => ['bail', 'nullable', 'integer', Rule::exists("level_one_categories", "id")],
        ];
    }
}
