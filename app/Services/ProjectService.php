<?php

namespace Dashboard\Services;

use Dashboard\Repositories\ProjectRepository;
use Dashboard\Validators\ProjectValidator;

class ProjectService
{
    private $repository;
    private $validator;
    
    public function __construct(ProjectRepository $repository, ProjectValidator $validator)
    {
        $this->repository = $repository;
        
        $this->validator = $validator;
    }
    
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
}