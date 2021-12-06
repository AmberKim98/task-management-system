<?php

namespace App\Services\Validation;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee;
use DB;
use Auth;
use log;

class LoginValidation
{
    public function loginValidation($login_info)
    {
        $rules = [
            'email' =>  'required',
            'password' => 'required'
        ];
        $validator = Validator::make($login_info->all(), $rules);

        if ($validator->fails()) {
            redirect()->route('login')->withInput()->withErrors($validator->errors());
            return false;
        }
        else{
            $email = $login_info->get('email');
            $password = $login_info->get('password');
            $remember_me=$login_info->has('remember') ? true : false;
            if(auth()->attempt(['email' => $email, 'password' => $password], $remember_me)){
                return redirect()->route('project#projectList');
            }
            else {       
                redirect()->route('login')->withErrors([
                    'authFailure' => 'true'
                ]); 
                return false;
            }
        }
    }
}
