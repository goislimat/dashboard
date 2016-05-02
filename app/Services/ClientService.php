<?php
/**
 * Created by PhpStorm.
 * User: thiago
 * Date: 20/03/16
 * Time: 15:31
 */

namespace Dashboard\Services;


use Dashboard\Repositories\ClientRepository;
use Dashboard\Validators\ClientValidator;

class ClientService
{
    /**
     * @var ClientRepository
     */
    protected $repository;
    
    /**
    * @var ClientValidator
    */
    protected $validator;

    public function __construct(ClientRepository $repository, ClientValidator $validator) {
        $this->repository = $repository;
        
        $this->validator = $validator;
    }

    public function store(array $data) {
        try 
        {
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

    public function update(array $data, $id) {
        try 
        {
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