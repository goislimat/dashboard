<?php

namespace Dashboard\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Dashboard\Repositories\ProjectNoteRepository;
use Dashboard\Entities\ProjectNote;
use Dashboard\Validators\ProjectNoteValidator;

/**
 * Class ProjectNoteRepositoryEloquent
 * @package namespace Dashboard\Repositories;
 */
class ProjectNoteRepositoryEloquent extends BaseRepository implements ProjectNoteRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectNote::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
