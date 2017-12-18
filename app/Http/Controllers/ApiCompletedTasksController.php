<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTask;
use App\Task;
use Illuminate\Http\Request;

class ApiCompletedTasksController extends Controller
{
    /**
     * @param StoreTask $request
     * @return mixed
     */
    public function store(StoreTask $request)
    {
        $request->validate([
            'completed' => 'required',
        ]);

        $task = Task::create($request->only([ 'completed']));

        return $task;
    }
}
