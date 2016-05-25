<?php

namespace Dashboard\Services;

use Dashboard\Repositories\ProjectRepository;
use Dashboard\Validators\ProjectValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectService
{
    /**
     * @var ProjectRepository
     */
    private $repository;
    /**
     * @var ProjectValidator
     */
    private $validator;

    /**
     * ProjectService constructor.
     * @param ProjectRepository $repository
     * @param ProjectValidator $validator
     */
    public function __construct(ProjectRepository $repository, ProjectValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * Does the store procedure for projects
     *
     * @param array $data
     * @return array|mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(array $data)
    {
        try{
            $this->validator->with($data)->passesOrFail();
            
            return $this->repository->create($data);
        }
        catch(ValidatorException $e)
        {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    /**
     * Does the update procedure for projects
     *
     * @param array $data
     * @param $id
     * @return array|mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(array $data, $id)
    {
        try{
            $this->validator->with($data)->passesOrFail();
            
            return $this->repository->update($data, $id);
        }
        catch(ValidatorException $e)
        {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    /**
     * Add a user to the members list for a project
     *
     * @param $projectId
     * @param $userId
     * @return mixed
     */
    public function addMember($projectId, $userId)
    {
        return $this->repository->find($projectId)->members()->attach($userId);
    }

    /**
     * Remove a user to the members list for a project
     *
     * @param $projectId
     * @param $userId
     * @return mixed
     */
    public function removeMember($projectId, $userId)
    {
        return $this->repository->find($projectId)->members()->dettach($userId);
    }

    /**
     * Try to find a member for the project
     *
     * @param $projectId
     * @param $userId
     * @return bool
     */
    public function isMember($projectId, $userId)
    {
        $project = $this->repository->find($projectId);

        foreach($project->members as $member)
        {
            if($member->id == $userId)
            {
                return true;
            }
        }

        return false;
    }

    /**
     * Tests if the user is the owner of the project
     *
     * @param $projectId
     * @param $userId
     * @return bool
     */
    public function isOwner($projectId, $userId)
    {
        return (count($this->repository->findWhere(['id' => $projectId, 'owner_id' => $userId])) > 0) ? true : false;
    }
}