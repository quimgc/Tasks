<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyTask;
use App\Http\Requests\ListTask;
use App\Http\Requests\ShowTask;
use App\Http\Requests\StoreTask;
use App\Http\Requests\UpdateTask;
use App\Task;
use Illuminate\Http\Request;

/**
 * Class ApiTaskController.
 */
class ApiTaskController extends Controller
{
    /**
     * @param ListTask $request
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index(ListTask $request)
    {
        return Task::all();
    }

    /**
     * @param Task $task
     *
     * @return Task
     */
    public function show(ShowTask $request, Task $task)
    {
        //return $this->Object->show($task); això era per retornar el nom, es fara més avant.
        return $task;
    }

    //La funció del request s'anomena injeccio de dependències.

    /**
     * @param StoreTask $request a mida, quines normes de validació a de complir aquella request.
     *
     * @return mixed
     */
    public function store(StoreTask $request)
    {

        $request->validate([
            'name'    => 'required',
            'user_id' => 'required',
            'description' => 'required',
        ]);

        $task = Task::create($request->only(['name', 'user_id', 'description']));
        return $task;
    }

    /**
     * @param DestroyTask $request
     * @param Task        $task
     *
     * @return Task
     */
    public function destroy(DestroyTask $request, Task $task)
    {
        //el Task $task és equivalent a $task = Task::findOrFail($id)

        $task->delete();

        return $task;
    }

    /**
     * @param UpdateTask $request
     * @param Task       $task
     *
     * @return Task
     */
    public function update(UpdateTask $request, Task $task)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $task->name = $request->name;
        $task->save();

        return $task;
    }
}
