<?php
namespace App\Interfaces\Services\Task;

interface TaskServiceInterface
{
    public function addNewTask($request);
    public function getTask($request);
    public function editTask($request, $id);
    public function getAllProjects();
    public function getAllEmployees();
}
