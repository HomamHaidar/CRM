<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email,'.$this->id,
            'profile_links'=>'required',
            'type'=>'required',
            'company_id'=>'required',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name field must be a string.',
            'name.max' => 'The name field must not exceed 255 characters.',

            'phone.required' => 'The phone field is required.',
            'phone.string' => 'The phone field must be a string.',
            'phone.max' => 'The phone field must not exceed 20 characters.',

            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'The email address is already in use.',

            'profile_links.required' => 'The profile links field is required.',
            'type.required' => 'The type field is required.',
            'company_id.required' => 'The company field is required.',


        ];
    }
}
