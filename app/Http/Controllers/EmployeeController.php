<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Interfaces\Services\Employee\EmployeeServiceInterface;
use App\Models\Employee;
use App\Notifications\Employee\EmployeeCreatedNotification;
use App\Notifications\Employee\EmployeeDeletedNotification;
use App\Notifications\Employee\EmployeeUpdatedNotification;
use App\Events\Employee\EmployeeCreated;
use App\Events\Employee\EmployeeDeleted;
use App\Events\Employee\EmployeeUpdated;
use Illuminate\Support\Facades\Notification;
use Auth;
use Log;

// use App\Events\employeeCreated;

class EmployeeController extends Controller
{
    private $employeeInterface;

    /**
     * Class constructor
     * 
     * @param EmployeeServiceInterface $employeeInterface
     */
    public function __construct(EmployeeServiceInterface $employeeInterface)
    {
        $this->employeeInterface = $employeeInterface;
    }

    /**
     * Show add new employee form.
     * 
     */
    public function showCreateEmployeeForm()
    {   
        return view('employee.add-new-employee');
    }

    /**
     * Create new employee and store data to table
     * 
     * @param EmployeeRequest $request
     * @return object
     */
    public function submitCreateEmployeeForm(EmployeeRequest $request)
    {
        $employee = new Employee();
        $employee->employee_name = $request->employee_name;
        $employee->email = $request->email;
        $employee->profile = $request->profile;
        $employee->address = $request->address;
        $employee->phone = $request->phone;
        $employee->dob = $request->dob;
        $employee->position = $request->position;
        $employee->save();
        return response()->json([
            'message' => 'Successfully created!'
        ]);
        // $this->employeeInterface->addNewEmployee($request);
        // $employee_id = Employee::where('employee_id',auth()->user()->employee_id)->get('employee_id');
        // Notification::send($employee_id, new EmployeeCreatedNotification());
        // event(new EmployeeCreated());
        // return redirect()->route('employee#employeeList')->with('success','A new employee was successfully added!');
    }

    /**
     * Show employee list.
     * 
     */
    public function showEmployeeList(Request $request)
    {
        Log::info('request...');
        Log::info($request);
        $employees = $this->employeeInterface->searchEmployee($request);
        return response()->json($employees);
    }

    /**
     * Show employee profile.
     * 
     */
    public function showEmployeeProfile(int $id)
    {
        $employee = Employee::where('employee_id',$id)->first();
        return view('employee.show-profile', ['employee' => $employee]);
    }

    /**
     * Show employee profile edit form
     * 
     */
    public function showEditProfileForm(int $id)
    {
        $employee = Employee::where('employee_id',$id)->first();
        return view('employee.edit-employee', ['employee' => $employee]);
    }
     /**
     * Submit employee profile edit form
     * 
     */
    public function submitEditProfileForm(UpdateProfileRequest $request, int $id)
    {
        $this->employeeInterface->editEmployee($request, $id);
        $employee_id = Employee::where('employee_id',auth()->user()->employee_id)->get('employee_id');
        Notification::send($employee_id, new EmployeeUpdatedNotification());
        event(new EmployeeUpdated());
        return redirect()->route('employee#employeeList')->with('success','The employee record was successfully updated!');
    }
    /**
     * Delete record of specific employee
     * 
     */
    public function deleteEmployee(int $id)
    {
        $this->employeeInterface->deleteEmployee($id);
        $employee_id = Employee::where('employee_id',auth()->user()->employee_id)->get('employee_id');
        Notification::send($employee_id, new EmployeeDeletedNotification());
        event(new EmployeeDeleted());
        return redirect()->back()->with('success', 'The employee record was successfully deleted!');
    }
}
