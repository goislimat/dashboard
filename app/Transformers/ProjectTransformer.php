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
        'client',
        'members',
        'tasks',
        'files',
        'notes',
    ];

    /**
     * Transform the \Project entity
     * @param Project $project
     * @return array
     * @internal param \Project $model
     *
     */
    public function transform(Project $project)
    {
        return [
            'id'  => $project->id,
            'client_id'   => $project->client_id,
            'owner_id'    => $project->owner_id,
            'name'        => $project->name,
            'description' => $project->description,
            'progress'    => (int) $project->progress,
            'status'      => $project->status,
            'due_date'    => $project->due_date,  
        ];
    }

    public function includeClient(Project $project)
    {
        return $this->item($project->client, new ClientTransformer());
    }
    
    public function includeMembers(Project $project)
    {
        return $this->collection($project->members, new ProjectMembersTransformer());
    }

    public function includeTasks(Project $project)
    {
        return $this->collection($project->tasks, new ProjectTaskTransformer());
    }

    public function includeFiles(Project $project)
    {
        return $this->collection($project->files, new ProjectFileTransformer());
    }

    public function includeNotes(Project $project)
    {
        return $this->collection($project->notes, new ProjectNoteTransformer());
    }

}
