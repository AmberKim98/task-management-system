<?php
namespace App\Dao\Task;

use App\Models\Task;
use App\Models\Employee;
use App\Models\Project;
use App\Interfaces\Dao\Task\TaskDaoInterface;

class TaskDao implements TaskDaoInterface{
    /**
     * Add new task
     * 
     * @param TaskRequest $request
     */
    public function addNewTask($request)
    {
        $task = [
            'project_id' => $request->project_name,
            'task_title' => $request->title,
            'description' => $request->description,
            'assigned_member_id' => (int)$request->assigned_employee,
            'estimate_hr' => $request->estimate_hr,
            'estimate_start_date' => $request->estimate_start_date_time,
            'estimate_finish_date' => $request->estimate_finish_date_time
        ];
        return Task::create($task);
    }

    /**
     * Admin search tasks by search criteria
     * 
     * @param Request $request
     */
    public function adminSearchTask($request, $id)
    {
        if($request->title) //Search by title
        {
            $tasks = Task::where('task_title', $request->title);
        }
        if($request->project_name) //Search by project_name
       {
            $project_id = Project::where('project_name', 'LIKE', "%$request->project_name%")->value('project_id');
            $tasks = Task::where('project_id', $project_id);
       }
       if($request->assigned_employee) //Search by assigned_employee
       {
           $employee_id = Employee::where('employee_name', 'LIKE', "%$request->assigned_employee%")->value('employee_id');
           $tasks = Task::where('assigned_member_id', $employee_id);
       }
       if(isset($request->status)) //Search by status
       {
            $tasks = Task::where('status', $request->status);
       }
       if($request->title && $request->project_name)  //Search by title and project_name
       {
            $project_id = Project::where('project_name', 'LIKE', "%$request->project_name%")->value('project_id');
            $tasks = Task::where('task_title', $request->title)
                        ->orWhere('project_id', $project_id);
       }
       if($request->title && $request->assigned_employee) //Search by title and assigned_employee
       {
            $employee_id = Employee::where('employee_name', 'LIKE', "%$request->assigned_employee%")->value('employee_id');
            $tasks = Task::where('task_title', $request->title)
                        ->orWhere('assigned_member_id', $employee_id);
       }
       if($request->title && isset($request->status)) //Search by title and status
       {
            $tasks = Task::where('task_title', $request->title)
                        ->orWhere('status', $request->status);
       }
       if($request->project_name && $request->assigned_employee) //Search by project_name and assigned_employee
       {
            $project_id = Project::where('project_name', 'LIKE', "%$request->project_name%")->value('project_id');
            $employee_id = Employee::where('employee_name', 'LIKE', "%$request->assigned_employee%")->value('employee_id');
            $tasks = Task::where('project_id', $project_id)
                        ->orWhere('assigned_member_id', $employee_id);
       }
       if($request->project_name && isset($request->status)) //Search by project_name and status
       {
            $project_id = Project::where('project_name', 'LIKE', "%$request->project_name%")->value('project_id');
            $tasks = Task::where('project_id', $project_id)
                        ->orWhere('status', $request->status);
       }
       if($request->assigned_employee && isset($request->status)) //Search by assigned_employee and status
       {
            $employee_id = Employee::where('employee_name', 'LIKE', "%$request->assigned_employee%")->value('employee_id');
            $tasks = Task::where('assigned_member_id', $employee_id)
                            ->orWhere('status', $request->status);
       }
       if($request->title && $request->project_name && $request->assigned_employee) //Search by title, project_name and assigned_employee
       {
            $project_id = Project::where('project_name', 'LIKE', "%$request->project_name%")->value('project_id');
            $employee_id = Employee::where('employee_name', 'LIKE', "%$request->assigned_employee%")->value('employee_id');
            $tasks = Task::where('task_title', $request->title)
                        ->orWhere('project_id',  $project_id)
                        ->orWhere('assigned_member_id', $employee_id);
       }
       if($request->title && $request->project_name && $request->status) //Search by title, project_name and status
       {
            $project_id = Project::where('project_name', 'LIKE', "%$request->project_name%")->value('project_id');
            $tasks = Task::where('task_title', $request->title)
                        ->orWhere('project_id',  $project_id)
                        ->orWhere('status', $request->status);
       }
       if($request->title && $request->assigned_employee && $request->status) //Search by title, assigned_employee and status
       {
            $employee_id = Employee::where('employee_name', 'LIKE', "%$request->assigned_employee%")->value('employee_id');
            $tasks = Task::where('task_title', $request->title)
                        ->orWhere('assigned_member_id',  $employee_id)
                        ->orWhere('status', $request->status);
       }
       if($request->project_name && $request->assigned_employee && $request->status) //Search by project_name, assigned_employee and status
       {
            $project_id = Project::where('project_name', 'LIKE', "%$request->project_name%")->value('project_id');
            $employee_id = Employee::where('employee_name', 'LIKE', "%$request->assigned_employee%")->value('employee_id');
            $tasks = Task::where('status', $request->status)
                        ->orWhere('project_id',  $project_id)
                        ->orWhere('assigned_member_id', $employee_id);
       }

       if($request->title && $request->project_name && $request->assigned_employee && isset($request->status)) //Search by all criteria
       {
            $project_id = Project::where('project_name', 'LIKE', "%$request->project_name%")->value('project_id');
            $employee_id = Employee::where('employee_name', 'LIKE', "%$request->assigned_employee%")->value('employee_id');
            $tasks = Task::where('task_title', $request->title)
                        ->orWhere('project_id',  $project_id)
                        ->orWhere('assigned_member_id', $employee_id)
                        ->orWhere('status', $request->status);
       }
       return $tasks->paginate(5);
    }

    /**
     * Member search tasks by search criteria
     * 
     */
    public function memberSearchTask($request, $id)
    {
       if($request->title)
       {
            $tasks = Task::where('task_title', $request->title)->where('assigned_member_id', $id);
       }
       if($request->project_name)
       {
            $project_id = Project::where('project_name', 'LIKE', "%$request->project_name%")->value('project_id');
            $tasks = Task::where('project_id', $project_id)->where('assigned_member_id', $id);
       }
       if(isset($request->status))
       {
            $tasks = Task::where('status', $request->status)->where('assigned_member_id', $id);
       }
       if($request->title && $request->project_name)
       {
            $project_id = Project::where('project_name', 'LIKE', "%$request->project_name%")->value('project_id');
            $tasks = Task::where('task_title', $request->title)
                    ->orWhere('project_id', $project_id)->where('assigned_member_id', $id);
       }
       if($request->project_name && $request->status)
       {
            $project_id = Project::where('project_name', 'LIKE', "%$request->project_name%")->value('project_id');
            $tasks = Task::where('project_id', $project_id)
                    ->orWhere('status', $request->status)->where('assigned_member_id', $id);
       }
       if($request->title && $request->project_name && isset($request->status))
       {
            $project_id = Project::where('project_name', 'LIKE', "%$request->project_name%")->value('project_id');
            $tasks = Task::where('task_title', $request->title)
                        ->orWhere('project_id',  $project_id)
                        ->orWhere('status', $request->status)
                        ->where('assigned_member_id', $id);
       }
        return $tasks->paginate(5);
    }

    /**
     * Show all tasks.
     * 
     */
    public function getAllTask($position, $name, $id)
    {
        switch($position)
        {
            case 0 : return Task::paginate(5); break;
            case 1 : return Task::where('assigned_member_id', $id)->paginate(5); break;
            default : return;
        }
    }

    /**
     * Edit tasks and store updated data in tasks table.
     * 
     * @param UpdateTaskRequest $request, int $id
     */
    public function editTask($request, $id)
    {
          $project_id = $request->project_name;
          $tasks = [
               'project_id' => $project_id,
               'task_title' => $request->title,
               'description' => $request->description,
               'assigned_member_id' => $request->assignee_name,
               'estimate_hr' => $request->estimate_hr,
               'estimate_start_date' => $request->estimate_start_date_time,
               'estimate_finish_date' => $request->estimate_finish_date_time,
               'actual_hr' => $request->actual_hr,
               'status' => $request->status,
               'actual_start_date' => $request->actual_start_date_time,
               'actual_finish_date' => $request->actual_finish_date_time
          ];
          return Task::where('task_id', $id)->update($tasks);
    }

    public function getAllProjects()
    {
        return Project::whereNull('deleted_at')->get();
    }

    public function getAllEmployees()
    {
        return Employee::whereNull('deleted_at')->get();
    }
}
