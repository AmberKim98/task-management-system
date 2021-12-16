<?php
namespace App\Dao\Employee;

use App\Interfaces\Dao\Employee\EmployeeDaoInterface;
use App\Models\Employee;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Hash;
use Log;
use Illuminate\Http\Request;

class EmployeeDao implements EmployeeDaoInterface
{
    /**
     * Create new employee and store data to table.
     * 
     * @param EmployeeRequest $request
     * @return object
     */
    public function addNewEmployee($request)
    {
        $employee = [
            'employee_name' => $request->name,
            'email' => $request->email,
            'profile' => $request->profile,
            'address' => $request->address,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'position' => $request->position
        ];
        $result = Employee::create($employee);
        if($result && $request->profile)
        {
            $name = $result->employee_id.'.'.$request->profile->getClientOriginalExtension();
            $destinationPath = public_path('img/employee/employee_profiles');
            $imagePath = env('APP_URL').'/img/employee/employee_profiles/'. $name;
            $result->profile->move($destinationPath,$name);
            $result->profile = $imagePath;
            $result->save();
        }
        return $result;
    }
    /**
     * Edit employee profile with specific ID.
     * 
     */
    public function editEmployee($request, $id)
    {
        $employee = [
            'employee_name' => $request->name,
            'email' => $request->email,
            'profile' => $request->profile,
            'address' => $request->address,
            'phone' => $request->phone,
            'dob' => $request->dob
        ];
        
        if($request->new_password)
        {
            $employee['password'] = Hash::make($request->new_password);
        }
        if($request->position)
        {
            $employee['position'] = $request->position;
        }
        
        $result = Employee::where('employee_id', $id)->update($employee);
        return $result;
    }

    /**
     * Search employee by ID or name.
     * 
     * @param Request $request
     * @return object
     */
    public function searchEmployee($request)
    {
        $search_result = null;
        if ($request->employee_id || $request->employee_name) {
            Log::info($request);
            if ($request->employee_id) $search_result = Employee::where('employee_id', 'LIKE', "%$request->employee_id%");

            if ($request->employee_name) $search_result = Employee::where('employee_name', 'LIKE', "%$request->employee_name%");
            
            if ($request->employee_id && $request->employee_name) $search_result = Employee::where('employee_id', 'LIKE', "%$request->employee_id%")
                                            ->orWhere('employee_name', 'LIKE', "%$request->employee_name%");
            return $search_result->paginate(5);
        }
        else return Employee::paginate(5);
    }
    /**
     * Delete record of specific employee.
     * 
     * @param $id
     */
    public function deleteEmployee($id)
    {
        Employee::find($id)->delete();
        return response()->json("Successfully deleted!");
    }
    /**
     * Check user for edit profile action.
     * 
     */
    public function getEmployeePosition($id)
    {
        return Employee::where('employee_id', $id)->value('position');
    }
}
