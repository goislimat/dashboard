<?php

namespace Dashboard\Transformers;

use League\Fractal\TransformerAbstract;
use Dashboard\Entities\ProjectFile;

/**
 * Class ProjectFileTransformer
 * @package namespace Dashboard\Transformers;
 */
class ProjectFileTransformer extends TransformerAbstract
{

    /**
     * Transform the \ProjectFile entity
     * @param ProjectFile|\ProjectFile $model
     * @return array
     */
    public function transform(ProjectFile $model)
    {
        return [
            'id'         => (int) $model->id,

            'project_id' => $model->project_id,
            'name'       => $model->name,
            'extension'  => $model->extension,
            'description'=> $model->description,
        ];
    }
}
