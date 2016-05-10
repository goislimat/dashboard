<?php
/**
 * Created by PhpStorm.
 * User: goisl
 * Date: 10/05/2016
 * Time: 11:47
 */

namespace Dashboard\Services;


use Dashboard\Repositories\ProjectTaskRepository;
use Dashboard\Validators\ProjectValidator;
use Illuminate\Contracts\Validation\ValidationException;

class ProjectTaskService
{
    /**
     * @var ProjectTaskRepository
     */
    private $repository;
    /**
     * @var ProjectValidator
     */
    private $validator;

    /**
     * ProjectTaskService constructor.
     * @param ProjectTaskRepository $repository
     * @param ProjectValidator $validator
     */
    public function __construct(ProjectTaskRepository $repository, ProjectValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * @param array $data
     * @return mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(array $data)
    {
        try
        {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        }
        catch(ValidationException $e)
        {
            return [
                'error' => true,
                'message' => 'There are errors in your form. Please, fix them.'
            ];
        }

    }

    /**
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id)
    {
        try
        {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);
        }
        catch(ValidationException $e)
        {
            return [
                'error' => true,
                'message' => 'There are errors in your form. Please, fix them.'
            ];
        }
    }
}