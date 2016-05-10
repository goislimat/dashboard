<?php

namespace Dashboard\Http\Controllers;

use Dashboard\Repositories\ProjectTaskRepository;
use Illuminate\Http\Request;

use Dashboard\Http\Requests;

class ProjectTaskController extends Controller
{
    /**
     * @var ProjectTaskRepository
     */
    private $repository;

    /**
     * ProjectTaskController constructor.
     * @param ProjectTaskRepository $repository
     */
    public function __construct(ProjectTaskRepository $repository)
    {
        $this->repository = $repository;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
