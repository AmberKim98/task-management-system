<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Rules\MatchPassword;

class UpdateProfileRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'name' => 'required|string|regex:/^[\pL\s\-]+$/u',
            'email' => ['email', Rule::unique('employees')->ignore($request->employee_id, 'employee_id')],
            'profile' => ['nullable','mimes:jpg,png'],
            'address' => 'string|max:255',
            'phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|max:11',
            'dob' => 'date',
            'old_password' => ['nullable','min:6', new MatchPassword($request->employee_id)],
            'new_password' => 'nullable|min:6|confirmed'
        ];

    }
}
