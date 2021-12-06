<?php
namespace App\Dao\Project;

use App\Interfaces\Dao\Project\ProjectDaoInterface;
use App\Models\Project;

class ProjectDao implements ProjectDaoInterface
{
    /**
     * Create new project.
     * 
     * @param ProjectRequest $request
     */
    public function addNewProject($request)
    {
        $project = [
            'project_name'=>$request->project_name,
            'language'=>$request->language,
            'description'=>$request->description,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date
        ];
        $result = Project::Create($project);
        return $result;
    }

    /**
     * Search project by project name or language.
     * 
     * @param ProjectRequest $request
     */
    public function searchProject($request)
    {
        $search_result = null;

        if($request->project_name || $request->language)
        {
            if($request->project_name)
            {
                $search_result = Project::where('project_name','LIKE', "%$request->project_name%");
            }
            if($request->language)
            {
                $search_result = Project::where('language','LIKE',"%$request->language%");
            }
            if($request->project_name && $request->language)
            {
                $search_result = Project::where('project_name','LIKE',"%$request->project_name%")
                                ->orWhere('language','LIKE',"%$request->language%");
            }
            return $search_result->paginate(5);
        }
        else return Project::paginate(5);
    }
    /**
     * Delete record of specific project.
     * 
     *@param $id
     */
    public function deleteProject($id)
    {
        return Project::find($id)->delete();
    }
    /**
     * Update record of specific project.
     * 
     * @param UpdateProjectRequest $request
     */
    public function editProject($request, $id)
    {
        $project = [
            'project_name' => $request->project_name,
            'language' => $request->language,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ];
        
        return Project::where('project_id', $id)->update($project);
    }
}
