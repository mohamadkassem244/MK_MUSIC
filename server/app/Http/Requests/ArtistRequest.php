<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArtistRequest extends FormRequest
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
            'real_name' => 'required|string|max:255',
            'job_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'start_date' => 'required|date',
            'retirement_date' => 'nullable|date',
            'gender' => 'required|in:male,female',
            'bio' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'country_id' => 'nullable|exists:countries,id',
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules = [
                'real_name' => 'sometimes|string|max:255',
                'job_name' => 'sometimes|string|max:255',
                'birth_date' => 'sometimes|date',
                'start_date' => 'sometimes|date',
                'retirement_date' => 'nullable|date',
                'gender' => 'sometimes|in:male,female',
                'bio' => 'nullable|string',
                'image' => 'nullable|string|max:255',
                'country_id' => 'nullable|exists:countries,id',
            ];
        }

        return $rules;
    }
}
