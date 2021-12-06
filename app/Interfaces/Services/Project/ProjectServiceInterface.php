<?php 
namespace App\Interfaces\Services\Project;

interface ProjectServiceInterface
{
    public function addNewProject($request);
    public function searchProject($request);
    public function deleteProject($id);
    public function editProject($request, $id);
}
