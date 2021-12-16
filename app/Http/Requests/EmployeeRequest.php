<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Log;

class EmployeeRequest extends FormRequest
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
            'name' => 'required|string|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|unique:employees',
            'profile' => 'mimes:jpg,png',
            'address' => 'string|max:255',
            'phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|max:11',
            'dob' => 'date',
            'position' => 'required'
        ];
    }
}
