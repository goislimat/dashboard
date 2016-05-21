<?php

namespace Dashboard\Transformers;

use League\Fractal\TransformerAbstract;
use Dashboard\Entities\User;

/**
 * Class ProjectMembersTransformer
 * @package namespace Dashboard\Transformers;
 */
class ProjectMembersTransformer extends TransformerAbstract
{

    /**
     * Transform the \ProjectMembers entity
     * @param User $member
     * @return array
     * @internal param \ProjectMembers $model
     */
    public function transform(User $member)
    {
        return [
            'member_id' => $member->id,
            'name'      => $member->name,
            'email'     => $member->email,
        ];
    }
}
