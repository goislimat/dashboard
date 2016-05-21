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
        ];
    }
}
