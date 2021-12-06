<?php

namespace App\Exports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TaskExport implements WithHeadings, FromQuery, WithMapping
{
    use Exportable;

    public function headings():array
    {
        return [
            'Task ID',
            'Task Title',
            'Description',
            'Project Name',
            'Assigned Employee',
            'Estimate Hr',
            'Actual Hr',
            'Status',
            'Estimate Start Date',
            'Estimate Finish Date',
            'Actual Start Date',
            'Actual Finish Date'
        ];
    }

     /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        $title = $projectName = $assigned_employee = $status = null;

        if(!empty(request()->get('title')))
        {
            $title = request()->title;
        }
        if(!empty(request()->get('project_name')))
        {
            $projectName = request()->project_name;
        }
        if(!empty(request()->get('assigned_employee')))
        {
            $assigned_employee = request()->assigned_employee;
        }
        if(!empty(request()->get('status')) || request()->get('status') !=null)
        {
            $status = request()->status;
        }

        if(!empty($title) || !empty($projectName) || !empty($assigned_employee) || !empty($status) || isset($status))
        {
            $tasks = Task::query()
            ->select( 'tasks.task_id', 'tasks.task_title', 'tasks.description', 'projects.project_name', 'employees.employee_name', 'estimate_hr', 'actual_hr', 'status', 'estimate_start_date', 'estimate_finish_date', 'actual_start_date', 'actual_finish_date')
            ->where('tasks.task_title', $title)
            ->orWhere('projects.project_name', $projectName)
            ->orWhere('employees.employee_name', $assigned_employee)
            ->orWhere('status',$status)
            ->join('projects', 'tasks.project_id', '=', 'projects.project_id')
            ->join('employees', 'tasks.assigned_member_id', '=', 'employees.employee_id');
        }
        else 
        {
            $tasks = Task::query()
            ->select( 'tasks.task_id', 'tasks.task_title', 'tasks.description', 'projects.project_name', 'employees.employee_name', 'estimate_hr', 'actual_hr', 'status', 'estimate_start_date', 'estimate_finish_date', 'actual_start_date', 'actual_finish_date')
            ->join('projects', 'tasks.project_id', '=', 'projects.project_id')
            ->join('employees', 'tasks.assigned_member_id', '=', 'employees.employee_id');
        }

        return $tasks;
    }

    public function map($tasks): array
    {
        switch($tasks->status)
        {
            case null : $tasks->status= 'Open'; break;
            case 1 : $tasks->status= 'In Progress'; break;
            case 2 : $tasks->status= 'Finish'; break;
            case 3 : $tasks->status= 'Close'; break;
        }

        return [
            $tasks->task_id,
            $tasks->task_title,
            $tasks->description,
            $tasks->project_name,
            $tasks->employee_name,
            $tasks->estimate_hr,
            $tasks->actual_hr,
            $tasks->status,
            $tasks->estimate_start_date,
            $tasks->estimate_finish_date,
            $tasks->actual_start_date,
            $tasks->actual_finish_date
        ];
    }

}
