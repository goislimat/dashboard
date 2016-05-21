<?php

namespace Dashboard\Repositories;

use Dashboard\Presenters\ProjectTaskPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Dashboard\Repositories\ProjectTaskRepository;
use Dashboard\Entities\ProjectTask;
use Dashboard\Validators\ProjectTaskValidator;

/**
 * Class ProjectTaskRepositoryEloquent
 * @package namespace Dashboard\Repositories;
 */
class ProjectTaskRepositoryEloquent extends BaseRepository implements ProjectTaskRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectTask::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @return mixed
     */
    public function presenter()
    {
        return ProjectTaskPresenter::class;
    }
}
