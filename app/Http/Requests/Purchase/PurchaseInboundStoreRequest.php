<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PurchaseInboundStoreRequest extends FormRequest
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
            "raised_date" => ['required', 'date'],
            'reference_invoice_number' => ['required'],
            "vendor_id" => ['required', 'integer', Rule::exists("vendors", "id")],
            "location_id" => ['required', 'integer', Rule::exists("locations", "id")],

            'purchase_inbound_items' => ['required', 'array'],

            "purchase_inbound_items.*.item_id" => ['bail', 'required', 'integer', Rule::exists("items", "id")],
            "purchase_inbound_items.*.quantity" => ['bail', 'required', 'numeric', 'min:0.1'],
            "purchase_inbound_items.*.unit_price" => ['bail', 'required', 'numeric', 'min:0.1'],
            "purchase_inbound_items.*.sub_total" => ['bail', 'required', 'numeric'],
            "purchase_inbound_items.*.vat" => ['bail', 'nullable', 'numeric'],
            "purchase_inbound_items.*.total" => ['bail', 'required', 'numeric'],
            "purchase_inbound_items.*.remark" => ['bail', 'nullable', 'string'],

            "sub_total" => ['bail', 'nullable', 'numeric'],
            "others" => ['bail', 'nullable', 'numeric'],
            "total" => ['bail', 'required', 'numeric'],
        ];
    }
}
