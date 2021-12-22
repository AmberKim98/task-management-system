<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Hash;
use Carbon\Carbon;

class EmployeeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Employee([
            'employee_name' => $row[0],
            'email' => $row[1],
            'password' => Hash::make($row[2]),
            'profile' => $row[3],
            'position' => $row[4],
            'address' => $row[5],
            'dob' => Carbon::parse($row[6]),
            'phone' => $row[7],
        ]);
    }
}
