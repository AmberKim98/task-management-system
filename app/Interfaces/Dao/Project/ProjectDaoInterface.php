<?php
namespace App\Interfaces\Dao\Project;

interface ProjectDaoInterface
{
    public function addNewProject($request);
    public function searchProject($request);
    public function deleteProject($id);
    public function editProject($request, $id);
}
