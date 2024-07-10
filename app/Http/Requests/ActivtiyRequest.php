<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivtiyRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'comment' => 'nullable',
            'start' => ['required', 'date', 'before:end'],
            'end' => 'required|date|after:start',
            'user_id' => 'required|integer|exists:users,id',
            'is_done' => 'boolean',


        ];

    }
    public function messages(): array
    {
        return [
            'title.required' => 'The name field is required.',
            'title.string' => 'The name field must be a string.',
            'title.max' => 'The name field must not exceed 255 characters.',

            'type.required' => 'The type field is required.',
            'type.string' => 'The type field must be a string.',
            'type.max' => 'The type field must not exceed 255 characters.',

            'start.required' => 'The from_time field is required.',
            'end.required' => 'The due_time field is required.',

            'start.date' => 'The from_time field must be date.',
            'end.date' => 'The due_time field must be date.',

            'start.before' => 'The from time must be a date before due time.',
            'end.after' => 'The due time must be a date after from time.',
            'user_id.required' => 'The user_id field is required.',
            'created_by.required' => 'The created_by field is required.',


            ];
    }
}
