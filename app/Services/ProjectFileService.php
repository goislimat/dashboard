<?php

namespace Dashboard\Services;

use Dashboard\Entities\Project;
use Dashboard\Repositories\ProjectFileRepository;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;

class ProjectFileService
{
    /**
     * @var ProjectFileRepository
     */
    private $repository;
    /**
     * @var Filesystem
     */
    private $file;
    /**
     * @var Storage
     */
    private $storage;

    /**
     * ProjectFileService constructor.
     * @param ProjectFileRepository $repository
     */
    public function __construct(ProjectFileRepository $repository, Filesystem $file, Storage $storage)
    {
        $this->repository = $repository;
        $this->file = $file;
        $this->storage = $storage;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function storeFile(array $data)
    {
        $this->storage->put($data['name'] . '.' . $data['extension'], $this->file->get($data['file']));

        return $this->repository->create($data);
    }
}