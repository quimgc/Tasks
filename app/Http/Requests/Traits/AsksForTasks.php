<?php

namespace App\Http\Requests\Traits;
use App\Task;


/**
 * Trait ChecksPermissions.
 */
trait AsksForTasks
{

    /**
     * @param $task
     * @return mixed
     */
    protected function askForTasks()
    {
        $tasks = Task::all();
        $task_names = $tasks->pluck('name')->toArray();
        $task_name = $this->choice('Task id?', $task_names);
        return $tasks->where('name', $task_name)->first()->id;

    }

}
