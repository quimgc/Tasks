<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {
    //    Route::resource('task', 'TasksController');

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    //adminlte_api_routes

    //USERS
    Route::get('/users', 'ApiUserController@index');
    Route::get('/users/{user}', 'ApiUserController@show');
    Route::delete('/users/{user}', 'ApiUserController@destroy');
    Route::put('/users/{user}', 'ApiUserController@update');
    Route::post('/users', 'ApiUserController@store');

    //RUTES API TASKS

    Route::get('/tasks', 'ApiTaskController@index');
    Route::get('/tasks/{task}', 'ApiTaskController@show');
    Route::post('/tasks', 'ApiTaskController@store');
    Route::delete('/tasks/{task}', 'ApiTaskController@destroy');
    Route::put('/tasks/{task}', 'ApiTaskController@update');

    //Route::post('/tasks/{task}/completed','ApiTaskController@completed');
    //Route::post('/tasks/{task}/incompleted','ApiTaskController@incompleted');

});
