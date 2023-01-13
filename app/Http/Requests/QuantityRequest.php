<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuantityRequest extends FormRequest
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
            'quantity' => 'required',
            'size_id' => 'required',
            'color_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'size_id.required' => 'The size name field is required.',
            'color_id.required' => 'The color name field is required.',
        ];
    }
}
