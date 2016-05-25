<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('app');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['middleware' => 'oauth'], function() {
    Route::resource('client', 'ClientController', ['except' => ['create', 'edit']]);
    Route::resource('project', 'ProjectController', ['except' => ['create', 'edit']]);
    
    Route::group(['prefix' => 'project'], function() {
        Route::get('{projectId}/note', 'ProjectNoteController@index');
        Route::post('{projectId}/note', 'ProjectNoteController@store');
        Route::get('{projectId}/note/{id}', 'ProjectNoteController@show');
        Route::put('{projectId}/note/{id}', 'ProjectNoteController@update');
        Route::delete('{projectId}/note/{id}', 'ProjectNoteController@destroy');
        
        Route::resource('{projectId}/task', 'ProjectTaskController', ['except' => ['create', 'edit']]);

        Route::get('{projectId}/file', 'ProjectFileController@index');
        Route::post('{projectId}/file', 'ProjectFileController@store');

        Route::get('{id}/members', 'ProjectController@members');
    });

    Route::get('user/authenticated', 'UserController@authenticated');
});

