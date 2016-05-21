<?php

namespace Dashboard\Transformers;

use League\Fractal\TransformerAbstract;
use Dashboard\Entities\Client;

/**
 * Class ClientTransformer
 * @package namespace Dashboard\Transformers;
 */
class ClientTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['projects'];

    /**
     * Transform the \Client entity
     * @param \Client|Client $model
     * @return array
     */
    public function transform(Client $model)
    {
        return [
            'id'          => (int) $model->id,

            'name'        => $model->name,
            'responsible' => $model->responsible,
            'email'       => $model->email,
            'phone'       => $model->phone,
            'address'     => $model->address,
            'obs'         => $model->obs,

            //'created_at'  => $model->created_at,
            //'updated_at'  => $model->updated_at
        ];
    }

    public function includeProjects(Client $model)
    {
        return $this->collection($model->projects, new ProjectTransformer());
    }
}
