<?php

namespace App\Exports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\withHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;

class OvertimeTasksReport implements FromQuery, withHeadings, withMapping
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
            'Actual Finish Date',
            'Created At',
            'Updated_at'
        ];
    }

    public function query()
    {
        $today_date = date('Y-m-d');
        $tasks = Task::select( 'tasks.task_id', 'tasks.task_title', 'tasks.description', 'projects.project_name', 'employees.employee_name', 'estimate_hr', 'actual_hr', 'status', 'estimate_start_date', 'estimate_finish_date', 'actual_start_date', 'actual_finish_date', 'tasks.created_at', 'tasks.updated_at')
                    ->where(function($query) use($today_date) {
                        $query->where('estimate_finish_date', '<', $today_date)
                              ->whereNull('actual_start_date')
                              ->orWhereNotNull('actual_start_date')
                              ->whereNull('actual_finish_date')
                              ->whereNull('actual_hr')
                              ->whereIn('status', [0,1]);
                    })
                    ->orWhere(function($query) {
                        $query->whereNotNull('actual_start_date')
                              ->whereNotNull('actual_finish_date')
                              ->whereNotNull('actual_hr')
                              ->whereRaw('actual_hr > estimate_hr')
                              ->whereRaw('actual_finish_date > estimate_finish_date')
                              ->whereIn('status', [2,3]);
                    })
                    ->join('projects', 'tasks.project_id', '=', 'projects.project_id')
                    ->join('employees', 'tasks.assigned_member_id', '=', 'employees.employee_id');
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
