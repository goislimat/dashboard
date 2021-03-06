<?php

namespace Dashboard\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Dashboard\Repositories\ProjectRepository;
use Dashboard\Entities\Project;
use Dashboard\Validators\ProjectValidator;
use Dashboard\Presenters\ProjectPresenter;

/**
 * Class ProjectRepositoryEloquent
 * @package namespace Dashboard\Repositories;
 */
class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Project::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
    public function presenter()
    {
        return ProjectPresenter::class;
    }
}
