<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'project_name' => 'string|min:1|max:50',
            'language' => 'string|min:1|max:50',
            'description' => 'string|max:255',
            'start_date' => 'date',
            'end_date' => 'date'
        ];
    }
}
