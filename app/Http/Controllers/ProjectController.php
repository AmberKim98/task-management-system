<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Interfaces\Services\Project\ProjectServiceInterface;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private $projectInterface;

    public function __construct(ProjectServiceInterface $projectInterface)
    {
        $this->projectInterface = $projectInterface;
    }
    /**
     * Show new project creation form
     * 
     */
    public function showCreateProjectForm()
    {
        return view('project.create-new-project');
    }
    /**
     * Submit new project creation form
     *
     * @param ProjectRequest $request
     * @return response()  
     */
    public function submitCreateProjectForm(ProjectRequest $request)
    {
        $this->projectInterface->addNewProject($request);
        return redirect()->route('project#projectList')->with('success', 'A new project was sucessfully created!');
    }
    /**
     * Display project lists.
     * 
     */
    public function showProjectList(Request $request)
    {
        $projects = $this->projectInterface->searchProject($request);
        return view('project.projectlist',compact('projects'));
    }
    /**
     * Show project edit form.
     * 
     */
    public function showProjectEditForm(int $id)
    {
        $project=Project::where('project_id',$id)->first();
        return view('project.edit-project', ['project' => $project]);
    }
    /**
     * Submit project update form
     *
     * @param UpdateProjectRequest $request
     * @return response()  
     */
    public function submitProjectEditForm(UpdateProjectRequest $request, int $id)
    {
        $this->projectInterface->editProject($request, $id);
        return redirect()->route('project#projectList')->with('success','The project record was successfully updated!');
    }
    /**
     * Delete record of specific project.
     * 
     * @param $id
     */
    public function deleteProject(int $id)
    {
        $this->projectInterface->deleteProject($id);
        return redirect()->back()->with('success','The project record was successfully deleted!');
    }
}
