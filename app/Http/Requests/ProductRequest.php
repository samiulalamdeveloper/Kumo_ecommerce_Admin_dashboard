<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'product_name' => 'required|unique:products',
            'product_price' => 'required',
            'product_brand' => 'required',
            'long_desp' => 'required',
            'preview' => 'required',
            'preview' => 'mimes:jpg,jpeg,gif,png,webp',
            'preview' => 'file|max:5000',
            'thumbnail' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'The category name field is required',
            'subcategory_id.required' => 'The subcategory name field is required',
        ];
    }
}
