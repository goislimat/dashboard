<?php

namespace Dashboard\Http\Controllers;

use Illuminate\Http\Request;

use Dashboard\Http\Requests;

use Dashboard\Repositories\ProjectNoteRepository;
use Dashboard\Services\ProjectNoteService;

class ProjectNoteController extends Controller
{
    private $repository;
    private $service;
    
    public function __construct(ProjectNoteRepository $repository, ProjectNoteService $service)
    {
        $this->repository = $repository;
        
        $this->service = $service;
    }
    
    /**
     * Display a listing of the resource.
     *
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
    public function store(Request $request, $projectId)
    {
        return $this->service->store($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($projectId, $id)
    {
        $notes = $this->repository->findWhere(['project_id' => $projectId, 'id' => $id]);

        if(count($notes) > 0)
            return $notes['data'][0];

        return $notes;//erro
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $projectId, $id)
    {
        $this->service->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($projectId, $id)
    {
        //return ['error' => true, 'message' => 'de dentro do destroy do note'];
        $this->repository->delete($id);
    }
}
