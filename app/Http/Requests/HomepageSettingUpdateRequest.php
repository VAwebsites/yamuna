<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomepageSettingUpdateRequest extends FormRequest
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
            'logo' => ['nullable', 'image'],
            'project_title' => ['required', 'max:255', 'string'],
            'project_location' => ['required', 'max:255', 'string'],
            'rera_number' => ['required', 'string'],
            'youtube_link' => ['nullable', 'string'],
            'project_overview' => ['required', 'string'],
            'project_type' => ['required', 'max:255', 'string'],
            'project_status' => ['required', 'max:255', 'string'],
            'address_line_1' => ['nullable', 'max:255', 'string'],
            'address_line_2' => ['nullable', 'max:255', 'string'],
            'contact_number' => ['nullable', 'max:255', 'string'],
            'email' => ['nullable', 'email'],
            'footer_description' => ['nullable', 'max:255', 'string'],
        ];
    }
}
