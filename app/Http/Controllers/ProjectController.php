<?php

namespace Dashboard\Http\Controllers;

use Illuminate\Http\Request;

use Dashboard\Http\Requests;

use Dashboard\Repositories\ProjectRepository;
use Dashboard\Services\ProjectService;

use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ProjectController extends Controller
{
    private $repository;
    private $service;
    private $userId;
    
    public function __construct(ProjectRepository $repository, ProjectService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->userId = Authorizer::getResourceOwnerId();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->repository->with(['owner', 'client'])->findWhere(['owner_id' => $this->userId]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($this->checkPrivileges($id))
        {
            return $this->repository->with(['owner', 'client'])->find($id);
        }
        return ['error' => 'You don\'t have the access rights for this project'];
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
        if($this->checkPrivileges($id))
        {
            $this->service->update($request->all(), $id);
            return ['success' => true, 'message' => 'The project has been updated'];
        }
        return ['error' => 'You do not have access rights for this project'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->checkIsOwner($id))
        {
            $this->repository->delete($id);
            return ['success' => true, 'message' => 'The project has been deleted'];
        }
        return ['error' => 'You do not have access rights to finish this action'];
    }
    
    /**
    *
    * Authorization functions.
    */
    
    private function checkIsOwner($projectId)
    {   
        return $this->repository->isOwner($projectId, $this->userId);
    }
    
    private function checkIsMember($projectId)
    {
        return $this->repository->isMember($projectId, $this->userId);
    }
    
    private function checkPrivileges($projectId)
    {
        return ($this->checkIsOwner($projectId) || $this->checkIsMember($projectId)) ? true : false;
    }
}
