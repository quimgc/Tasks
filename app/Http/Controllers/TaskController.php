<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTask;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();

        return view('tasks_php', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();

        return view('create_task', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */

    //
    public function store(StoreTask $request)
    {
        Task::create([
            'name'          => $request->name,
            'description'   => $request->description,
            'user_id'       => $request->user_id,
        ]);

        Session::flash('status', 'Created ok!');

        return Redirect::to('/tasks_php/');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Task $task
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
//        Task::list([
//        'task'=>$task->name
//    ]);

        return view('show_task', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Task $task
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $users = User::all();

        return view('edit_task', ['task' => $task, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Task                $task
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $task->update($request->only(['name', 'user_id', 'description']));

        Session::flash('status', 'Edited ok!');

        return Redirect::to("/tasks_php/edit/$task->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Task $task
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        Session::flash('status', 'Task was deleted successful!');

        return Redirect::to('/tasks_php');
//        Task::destroy([
//            'id'=> $task->id
//        ]);
    }
}
