<?php
namespace App\Services\Project;

use App\Interfaces\Services\Project\ProjectServiceInterface;
use App\Interfaces\Dao\Project\ProjectDaoInterface;

class ProjectService implements ProjectServiceInterface
{
    private $projectDao;

    /**
     * Class constructor
     * 
     * @param ProjectDaoInterface $projectDao;
     */
    public function __construct(ProjectDaoInterface $projectDao)
    {
        $this->projectDao = $projectDao;
    }

    /**
     * Create new project.
     * 
     * @param ProjectRequest $request
     */
    public function addNewProject($request)
    {
        return $this->projectDao->addNewProject($request);
    }

    /**
     * Search project by project name or language.
     * 
     * @param Request $request
     */
    public function searchProject($request)
    {
        $results = $this->projectDao->searchProject($request);
        return $results;
    }

    /**
     * Delete record of specific project.
     * 
     * @param $id
     */
    public function deleteProject($id)
    {
        return $this->projectDao->deleteProject($id);
    }

    /**
     * Update record of specific project.
     * 
     * @param UpdateProjectRequest $request
     */
    public function editProject($request, $id)
    {
        return $this->projectDao->editProject($request, $id);
    }
}
