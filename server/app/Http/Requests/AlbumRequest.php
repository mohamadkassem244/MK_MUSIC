<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlbumRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'release_date' => 'required|date',
            'artist_id' => 'required|exists:artists,id',
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules = [
                'title' => 'sometimes|string|max:255',
                'release_date' => 'sometimes|date',
                'artist_id' => 'sometimes|exists:artists,id',
            ];
        }

        return $rules;
    }
}
