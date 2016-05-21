<?php

namespace Dashboard\Transformers;

use League\Fractal\TransformerAbstract;
use Dashboard\Entities\ProjectTask;

/**
 * Class ProjectTaskTransformer
 * @package namespace Dashboard\Transformers;
 */
class ProjectTaskTransformer extends TransformerAbstract
{
    //protected $defaultIncludes = ['project'];

    /**
     * Transform the \ProjectTask entity
     * @param ProjectTask|\ProjectTask $model
     * @return array
     */
    public function transform(ProjectTask $model)
    {
        return [
            'id'         => (int) $model->id,

            'name'       => $model->name,
            'start_date' => $model->start_date,
            'due_date'   => $model->due_date,
            'status'     => $model->status,
            'project_id' => $model->project_id,
            //'project' => $model->project

            //'created_at' => $model->created_at,
            //'updated_at' => $model->updated_at
        ];
    }

    public function includeProject(ProjectTask $model)
    {
        if($model->project)
            return $this->item($model->project, new ProjectTransformer);
    }
}
