<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Route;
use App\Interfaces\Services\Employee\EmployeeServiceInterface;

class EditProfileMiddleware
{
    private $employeeInterface;

    /**
     * Class constructor
     * 
     * @param EmployeeServiceInterface $employeeInterface
     */
    public function __construct(EmployeeServiceInterface $employeeInterface, Route $route)
    {
        $this->employeeInterface = $employeeInterface;
        $this->route = $route;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth()->user()->position == 1)
        {
            if($request->employee_id == Auth()->user()->employee_id)
            {
                return $next($request);
            }
            else return redirect()->back();
        }
        else
        {
            $position = $this->employeeInterface->getEmployeePosition($request->employee_id);

            if($position == 0 && (Auth()->user()->employee_id != $request->employee_id) && ($request->route()->getActionMethod() != 'showEmployeeProfile'))
            {
                return redirect()->back();
            }
            else
            {
                return $next($request);
            }
        }
    }
}
