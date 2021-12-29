<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Log;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromQuery;

class EmployeeExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function headings():array
    {
        return [
            'Employee ID',
            'Employee Name',
            'Email',
            'Position',
            'Address',
            'Date of Birth',
            'Phone'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        $employee_id = $employee_name = null;

        if(!empty(request()->get('employee_id')))
        {
            $employee_id = request()->employee_id;
        }
        if(!empty(request()->get('employee_name')))
        {
            $employee_name = request()->employee_name;
        }
        if(!empty(request()->get('employee_id')) && !empty(request()->get('employee_name')))
        {
            $employees = Employee::query()
                    ->select('employee_id', 'employee_name', 'email', 'position', 'address', 'dob', 'phone')
                    ->where('employee_name', 'LIKE', "%$employee_name%")
                    ->orWhere('employee_id', 'LIKE', "%$employee_id%");
            Log::info($employees);
        }
        else 
        {
            $employees = Employee::query()
                    ->select('employee_id', 'employee_name', 'email', 'position', 'address', 'dob', 'phone');
        }
        return $employees;
    }

    public function map($employees): array
    {
        switch($employees->position)
        {
            case 0 : $employees->position= 'Admin'; break;
            case 1 : $employees->position= 'Member'; break;
        }

        return [
            $employees->employee_id,
            $employees->employee_name,
            $employees->email,
            $employees->position,
            $employees->address,
            $employees->dob,
            $employees->phone
        ];
    }
}
