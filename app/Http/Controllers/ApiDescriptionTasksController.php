<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateDescriptionTask;
use App\Task;

class ApiDescriptionTasksController extends Controller
{
    /**
     * @param UpdateDescriptionTask $request
     * @param Task                  $task
     */
    public function update(UpdateDescriptionTask $request, Task $task)
    {
        $request->validate([
            'description' => 'required',
        ]);
        $task->description = $request->description;
        $task->save();

        return $task;
    }
}
