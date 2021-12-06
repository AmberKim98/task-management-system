<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Employee;
use App\Models\Task;
use App\Interfaces\Services\Task\TaskServiceInterface;
use App\Exports\TaskExport;
use Excel;
use Carbon\Carbon;

class TaskController extends Controller
{
    private $taskInterface;

    /**
     * Class constructor
     * 
     * 
     */
    public function __construct(TaskServiceInterface $taskInterface)
    {
        $this->taskInterface = $taskInterface;
    }

    /**
     * Show edit task form.
     * 
     */
    public function showEditTaskForm(int $id)
    {
        $task=Task::where('tasks.task_id',$id)->first();
        $projects=$this->taskInterface->getAllProjects();
        $employees=$this->taskInterface->getAllEmployees();
        return view('task.edit-task', compact('task','projects','employees'));
    }
    /**
     * Submit create task form.
     * 
     * @param UpdateTaskRequest $request, int $id
     * @return response()
     */
    public function submitEditTaskForm(UpdateTaskRequest $request, int $id)
    {
        $this->taskInterface->editTask($request, $id);
        return redirect()->route('task#taskList')->with('success', 'Task record was successfully updated!');
    }
    /**
     * show create task form
     * 
     */
    public function showCreateTaskForm()
    {
        $tasks=$this->taskInterface->getAllProjects();
        $employees=$this->taskInterface->getAllEmployees();
        return view('task.create-new-task',compact('tasks','employees'));
    }
    /**
     * Submit create task form.
     * 
     * @param TaskRequest $request
     * @return response()
     */
    public function submitCreateTaskForm(TaskRequest $request)
    {
        $this->taskInterface->addNewTask($request);
        return redirect()->route('task#taskList')->with('success','A new task was succesfully added!');
    }

    /**
     * show task list
     * 
     */
    public function showTaskList(Request $request)
    {
        $tasks=$this->taskInterface->getTask($request);
        return view('task.tasklist', compact('tasks'));
    }

    /**
     * Download task list
     * 
     */
    public function downloadTaskList(Request $request)
    {
        $today = Carbon::now()->format('Y-m-d H:i');
        $filename = 'tasks'.$today.'.xlsx';
        return Excel::download(new TaskExport(), $filename);        
    }
}
