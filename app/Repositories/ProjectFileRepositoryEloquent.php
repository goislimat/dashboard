<?php

namespace Dashboard\Repositories;

use Dashboard\Presenters\ProjectFilePresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Dashboard\Repositories\ProjectFileRepository;
use Dashboard\Entities\ProjectFile;
use Dashboard\Validators\ProjectFileValidator;

/**
 * Class ProjectFileRepositoryEloquent
 * @package namespace Dashboard\Repositories;
 */
class ProjectFileRepositoryEloquent extends BaseRepository implements ProjectFileRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectFile::class;
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
        return ProjectFilePresenter::class;
    }
}
