<?php
namespace App\Interfaces\Dao\Task;

interface TaskDaoInterface
{
    public function addNewTask($request);
    public function getAllTask($position,$name,$id);
    public function adminSearchTask($request, $id);
    public function memberSearchTask($request, $id);
    public function editTask($request, $id);
    public function getAllProjects();
    public function getAllEmployees();
}
