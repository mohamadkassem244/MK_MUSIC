<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrackRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'length' => 'required|date_format:H:i:s',
            'play_count' => 'nullable|integer|min:0',
            'image' => 'nullable|string|max:255',
            'path' => 'required|string|max:255|unique:tracks',
            'artist_id' => 'required|exists:artists,id',
            'album_id' => 'required|exists:albums,id',
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules = [
                'title' => 'sometimes|string|max:255',
                'length' => 'sometimes|date_format:H:i:s',
                'play_count' => 'nullable|integer|min:0',
                'image' => 'nullable|string|max:255',
                'path' => 'sometimes|string|max:255|unique:tracks',
                'artist_id' => 'sometimes|exists:artists,id',
                'album_id' => 'sometimes|exists:albums,id',
            ];
        }

        return $rules;
    }
}
