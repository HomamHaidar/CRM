<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'wholesale_price' => 'required|integer',
            'selling_price' => 'required|integer',
            'image' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name field must be a string.',
            'name.max' => 'The name field must not exceed 255 characters.',

            'quantity.required' => 'The quantity field is required.',
            'quantity.integer' => 'The quantity field must be a number.',

            'wholesale_price.required' => 'The wholesale_price field is required.',
            'wholesale_price.integer' => 'The wholesale_price field must be a number.',

            'selling_price.required' => 'The selling_price field is required.',
            'selling_price.integer' => 'The selling_price field must be a number.',

            'image.required' => 'The image field is required.',
            'image.image'=> 'The image field  should be image.',
            'image.mimes'=> 'The image field  should jpg,jpeg,png.',
        ];
}
}
