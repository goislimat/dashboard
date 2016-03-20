<?php
/**
 * Created by PhpStorm.
 * User: thiago
 * Date: 20/03/16
 * Time: 15:31
 */

namespace Dashboard\Services;


use Dashboard\Repositories\ClientRepository;

class ClientService
{
    /**
     * @var ClientRepository
     */
    protected $repository;

    public function __construct(ClientRepository $repository) {
        $this->repository = $repository;
    }

    public function create(array $data) {
        //manda email
        //notifca admin
        //envia tweet
        $this->repository->create($data);
    }

    public function update(array $data, $id) {
        $this->repository->update($data, $id);
    }
}