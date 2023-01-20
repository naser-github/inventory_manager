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
            'id' => ['required', 'integer', Rule::exists("stocks", "id")],
            'item_id' => ['required', 'integer', Rule::exists("items", "id")],
            'consumption_date' => ['required', 'date'],
            'stock' => ['required', 'numeric'],
            'consume' => ['required', 'numeric', 'min:0.01'],
            'location_id' => ['required', 'integer', Rule::exists("kitchen_stations", "id")],
        ];
    }
}
