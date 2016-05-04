<?php

namespace Dashboard\Http\Controllers;

use Dashboard\Services\ProjectFileService;
use Illuminate\Http\Request;

use Dashboard\Http\Requests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProjectFileController extends Controller
{
    /**
     * @var ProjectFileService
     */
    private $service;

    /**
     * ProjectFileController constructor.
     * @param ProjectFileService $service
     */
    public function __construct(ProjectFileService $service)
    {
        $this->service = $service;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $data = [
            'file' => $request->file('file'),
            'project_id' => $id,
            'name' => $request->name,
            'extension' => $request->file('file')->getClientOriginalExtension(),
            'description' => $request->description
        ];

        return $this->service->storeFile($data);
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
