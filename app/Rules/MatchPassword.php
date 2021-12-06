<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Hash;
use App\Models\Employee;

class MatchPassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($param)
    {
        $this->type = $param; 
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $id = $this->type;
        $current = Employee::where('employee_id',$id)->first();
        return Hash::check($value, $current->password);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Current password is incorrect. Please try again!';
    }
}
