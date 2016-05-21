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
    protected $defaultIncludes = ['project'];

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

            //'created_at' => $model->created_at,
            //'updated_at' => $model->updated_at
        ];
    }

    public function includeProject(ProjectFile $model)
    {
        return $this->collection($model->project, new ProjectTransformer());
    }
}
