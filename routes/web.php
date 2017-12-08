<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    //adminlte_routes
//
//    Route::get('/tasks',function(){
//
//       return view('tasks');
//
//    });

    //JS  + AJAX/AXIOS
    Route::view('/tokens', 'tokens');
    Route::view('/tasks', 'tasks');

    //route_php

//    Route::get('tasks_php', 'TaskController@index');
//    Route::get('tasks_php/edit/{task}', 'TaskController@edit');
//    //Route::get('tasks_php/{task}', 'TaskController@show');
//    Route::post('/tasks_php/{task}', 'TaskController@show');
//
//    Route::get('tasks_php/{task}', 'TaskController@show');
//
//    Route::post('tasks_php', 'TaskController@store');

    Route::get('tasks_php', 'TaskController@index');
    Route::get('tasks_php/create', 'TaskController@create');
    Route::get('tasks_php/edit/{task}', 'TaskController@edit');
    Route::get('tasks_php/{task}', 'TaskController@show');
    Route::post('tasks_php/{task}', 'TaskController@show');
    Route::post('tasks_php', 'TaskController@store');
    Route::put('tasks_php/{task}', 'TaskController@update');
    Route::delete('tasks_php/{task}', 'TaskController@destroy');

    //Els api s'ha de passar a api.php i refactoritzar tests per a que estiguin autenticats, per autenticar:    $this->actingAs($user,'api');
});
