<?php
namespace App\Services\Task;

use App\Interfaces\Services\Task\TaskServiceInterface;
use App\Interfaces\Dao\Task\TaskDaoInterface;
use App\Models\Employee;
use Auth;

class TaskService implements TaskServiceInterface
{
    private $taskDao;
    /**
     * Class constructor
     * 
     */
    public function __construct(TaskDaoInterface $taskDao)
    {
        $this->taskDao = $taskDao;
    }
    /**
     * Add new task.
     * 
     * @param TaskRequest $request
     */
    public function addNewTask($request)
    {
        return $this->taskDao->addNewTask($request);
    }

    /**
     * Search task by search criteria
     * 
     * @param Request $request
     */
    public function getTask($request)
    {
        $position = Auth::user()->position;
        $name = Auth::user()->employee_name;
        $id = Employee::where('employee_name', $name)->value('employee_id');

        if($request->title || $request->project_name || $request->assigned_employee || isset($request->status))
        {
            switch($position)
            {
                case 0 : $result = $this->taskDao->adminSearchTask($request, $id); break;
                case 1 : $result = $this->taskDao->memberSearchTask($request, $id); break;
            }
        }
        else
        {
            $result = $this->taskDao->getAllTask($position,$name,$id);
        }
        return $result;
    }

    /**
     * Edit tasks and store updated data in tasks table.
     * 
     * @param UpdateTaskRequest $request, int $id
     */
    public function editTask($request, $id)
    {
        return $this->taskDao->editTask($request, $id);
    }

    public function getAllProjects()
    {
        return $this->taskDao->getAllProjects();
    }

    public function getAllEmployees()
    {
        return $this->taskDao->getAllEmployees();
    }
}
