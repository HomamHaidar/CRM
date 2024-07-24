<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DealRequest extends FormRequest
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
            'title'=> 'required|string|max:255',
            'description'=> 'required',
            'user_id'=> 'required',
            'users_in'=> 'required',
            'expected_time'=> 'required',
            'start'=> 'required',
            'client_id'=> 'required',
            'product_id'=> 'required',
            'quantity'=> 'required',
            'tax'=> 'required',
            'total'=> 'required',
        ];
    }
}
