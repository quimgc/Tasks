<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTask;
use App\Http\Requests\UpdateCompletedTask;
use App\Task;

class ApiCompletedTasksController extends Controller
{
    /**
     * @param StoreTask $request
     *
     * @return mixed
     */
    public function update(UpdateCompletedTask $request, Task $task)
    {
        $request->validate([
        'completed' => 'required',
        ]);

        $task->completed = $request->completed;
        $task->save();

        return $task;
    }
}
