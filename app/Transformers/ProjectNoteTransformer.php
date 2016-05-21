<?php

namespace Dashboard\Transformers;

use League\Fractal\TransformerAbstract;
use Dashboard\Entities\ProjectNote;

/**
 * Class ProjectNoteTransformer
 * @package namespace Dashboard\Transformers;
 */
class ProjectNoteTransformer extends TransformerAbstract
{

    /**
     * Transform the \ProjectNote entity
     * @param ProjectNote|\ProjectNote $model
     * @return array
     */
    public function transform(ProjectNote $model)
    {
        return [
            'id'         => (int) $model->id,

            'project_id' => $model->project_id,
            'title'      => $model->title,
            'note'       => $model->note,
        ];
    }
}
