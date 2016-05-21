<?php

namespace Dashboard\Services;

use Dashboard\Repositories\ProjectFileRepository;
use Dashboard\Validators\ProjectFileValidator;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Prettus\Validator\Exceptions\ValidatorException;

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
     * @var ProjectFileValidator
     */
    private $validator;

    /**
     * ProjectFileService constructor.
     * @param ProjectFileRepository $repository
     * @param Filesystem $file
     * @param Storage $storage
     * @param ProjectFileValidator $validator
     */
    public function __construct(ProjectFileRepository $repository, Filesystem $file, Storage $storage, ProjectFileValidator $validator)
    {
        $this->repository = $repository;
        $this->file = $file;
        $this->storage = $storage;
        $this->validator = $validator;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function storeFile(array $data)
    {
        try
        {
            $this->validator->with($data)->passesOrFail();

            $this->storage->put($data['name'] . '.' . $data['extension'], $this->file->get($data['file']));
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

    public function destroy($id)
    {
        try {
            $projectFile = $this->repository->skipPresenter()->find($id);
            $this->repository->find($id)->delete();

            $fileName = $this->getFileName($projectFile);
            if($this->storage->exists($fileName))
                $this->storage->delete($fileName);

            return [
                'error' => false,
                'menssage' => 'The file '. $fileName .' has been deleted.'
            ];

        } catch (\Exception $e) {
            return [
                'error' => true,
                'menssage' => $e->getMessage()
            ];
        }
    }

    private function getFileName($projectFile)
    {
        return $projectFile->name .'.'. $projectFile->extension;
    }
}