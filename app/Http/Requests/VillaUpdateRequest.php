<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VillaUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'thumbnail' => ['image'],
            'description' => ['nullable', 'string'],
            'bhk' => ['required', 'numeric'],
            'sq_feet' => ['required', 'numeric'],
            'land_size' => ['nullable', 'numeric'],
            'price' => ['nullable', 'numeric'],
        ];
    }
}
