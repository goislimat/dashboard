<?php

namespace Dashboard\Http\Controllers;

use Dashboard\Repositories\ClientRepository;
use Dashboard\Services\ClientService;
use Illuminate\Http\Request;

use Illuminate\Database\QueryException as QueryException;

class ClientController extends Controller
{
    /**
     * @var ClientRepository
     */
    private $repository;
    
    /**
    * @var ClientService
    */
    private $service;

    public function __construct(ClientRepository $repository, ClientService $service)
    {
        $this->repository = $repository;
        
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->repository->all();
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
        return $this->repository->find($id);
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
        return ['success' => true, 'message' => 'The client has been updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $this->repository->delete($id);
            return ['success' => true, 'message' => 'The client has been deleted'];
        }
        catch(QueryException $e)
        {
            return ['error' => true, 'message' => 'Failed when trying to delete this client. You should first delete the projects owned by this client.'];
        }
        catch(\Exception $e)
        {
            return ['error' => true, 'message' => 'A unknown error has been thrown'];
        }
    }
}
