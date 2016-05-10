<?php

namespace Dashboard\Http\Controllers;

use Dashboard\Repositories\ProjectTaskRepository;
use Dashboard\Services\ProjectTaskService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use Dashboard\Http\Requests;

class ProjectTaskController extends Controller
{
    /**
     * @var ProjectTaskRepository
     */
    private $repository;
    /**
     * @var ProjectTaskService
     */
    private $service;

    /**
     * ProjectTaskController constructor.
     * @param ProjectTaskRepository $repository
     * @param ProjectTaskService $service
     */
    public function __construct(ProjectTaskRepository $repository, ProjectTaskService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $projectId
     * @return \Illuminate\Http\Response
     */
    public function index($projectId)
    {
        return $this->repository->findWhere(['project_id' => $projectId]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->store($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param $projectId
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($projectId, $id)
    {
        return $this->repository->findWhere(['project_id' => $projectId, 'id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->service->update($request->all(), $id);
        return ['success' => true, 'message' => 'The task has been updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $projectId
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($projectId, $id)
    {
        try
        {
            $this->repository->delete($id);
            return ['success' => true, 'message' => 'The task has been deleted'];
        }
        catch(ModelNotFoundException $e)
        {
            return ['error' => true, 'message' => $e->getMessage()];
        }
        catch(\Exception $e)
        {
            return ['error' => true, 'message' => 'A unknown error has been thrown'];
        }
    }
}
