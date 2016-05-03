<?php

namespace Dashboard\Transformers;

use League\Fractal\TransformerAbstract;
use Dashboard\Entities\Project;

/**
 * Class ProjectTransformer
 * @package namespace Dashboard\Transformers;
 */
class ProjectTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'members'
    ];
    
    /**
     * Transform the \Project entity
     * @param \Project $model
     *
     * @return array
     */
    public function transform(Project $project)
    {
        return [
            'project_id'  => $project->id,
            'client_id'   => $project->client_id,
            'owner_id'    => $project->owner_id,
            'name'        => $project->name,
            'description' => $project->description,
            'progress'    => $project->progress,
            'status'      => $project->status,
            'due_date'    => $project->due_date,  
        ];
    }
    
    public function includeMembers(Project $project)
    {
        return $this->collection($project->members, new ProjectMembersTransformer);
    }
}
