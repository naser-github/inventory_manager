<?php

namespace App\Http\Requests\Common;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class FilterbyDateAndLocation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }


    #[ArrayShape(['date' => "string[]", 'location' => "string[]"])] public function rules(): array
    {
        return [
            'date' => ['bail', 'nullable'],
            'location' => ['bail', 'nullable'],
        ];
    }
}
