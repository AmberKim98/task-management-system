<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Validation\LoginValidation;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $loginValidation;

    /**
     * Create an instance for login.
     * 
     */
    public function __construct(LoginValidation $loginValidation)
    {
        $this->loginValidation = $loginValidation;
    }
    /**
     * Index for login page.
     * 
     */
    public function index()
    {
        if(!Auth::check())
        {
            return view('login.login');
        }
        else return back();
    }
    /**
     * Show homepage.
     * 
     */
    public function home()
    {
        if(!Auth::check())
        {
            return view('login.login');
        }
        else return redirect()->route('task#taskList');
    }
    /**
     * Validate login information.
     * 
     * @param Illuminate\Http\Request  $request
     */
    public function loginValidate(Request $request)
    {
        $validation_check=$this->loginValidation->loginValidation($request);
        if($validation_check){
            return $validation_check;
        }
        else{
            return redirect()->route('login')->withInput();
        }
    }
    /**
     * Redirect to login page.
     * 
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
