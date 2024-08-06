<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'iso_3166_1_a_2' => 'required|string|size:2|unique:countries',
            'iso_3166_1_a_3' => 'required|string|size:3|unique:countries',
            'dialing_code' => 'required|string|max:10',
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules = [
                'name' => 'sometimes|string|max:255',
                'iso_3166_1_a_2' => 'sometimes|string|size:2|unique:countries',
                'iso_3166_1_a_3' => 'sometimes|string|size:3|unique:countries',
                'dialing_code' => 'sometimes|string|max:10',
            ];
        }

        return $rules;
    }
}
