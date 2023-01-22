<?php

namespace App\Http\Requests\Consumption;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ConsumptionStoreRequest extends FormRequest
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
            'location_id' => ['required', 'integer', Rule::exists("locations", "id")],
            'name' => ['required', 'string', 'min:2'],
            'consumption_date' => ['required', 'date'],

            'consumption_data' => ['required'],

            'consumption_data.*.item_id' => ['required', 'integer', Rule::exists("items", "id")],
            'consumption_data.*.quantity' => ['required', 'numeric', 'min:0.01'],
        ];
    }
}
