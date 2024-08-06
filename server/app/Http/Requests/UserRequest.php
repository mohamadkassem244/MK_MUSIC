<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'birth_date' => 'required|date',
            'image' => 'nullable|string|max:255',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',
            ],
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules = [
                'first_name' => 'sometimes|string|max:255',
                'last_name' => 'sometimes|string|max:255',
                'username' => 'sometimes|string|max:255|unique:users',
                'email' => 'sometimes|string|email|max:255|unique:users',
                'birth_date' => 'sometimes|date',
                'image' => 'nullable|string|max:255',
                'password' => [
                    'sometimes',
                    'string',
                    'min:8',
                    'regex:/[A-Z]/',
                ],
            ];
        }

        return $rules;
    }
}
