<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CompanyRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'field' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',

        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name field must be a string.',
            'name.max' => 'The name field must not exceed 255 characters.',

            'field.required' => 'The name field is required.',
            'field.string' => 'The name field must be a string.',
            'field.max' => 'The name field must not exceed 255 characters.',

            'address.required' => 'The address field is required.',
            'address.string' => 'The address field must be a string.',

            'phone.required' => 'The phone field is required.',
            'phone.string' => 'The phone field must be a string.',
            'phone.max' => 'The phone field must not exceed 20 characters.',

        ];
    }
}
