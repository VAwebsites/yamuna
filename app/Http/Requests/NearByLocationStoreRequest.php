<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NearByLocationStoreRequest extends FormRequest
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
            'img' => ['image'],
            'name' => ['required', 'max:255', 'string'],
            'order' => ['nullable', 'numeric'],
            'distance' => ['nullable', 'max:255', 'string'],
        ];
    }
}
