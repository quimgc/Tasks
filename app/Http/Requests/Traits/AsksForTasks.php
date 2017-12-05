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
     *
     * @return mixed
     */
    protected function askForTasks()
    {
        $tasks = Task::all();

        //pluck és com si es fes un foreach buscant per nom i afegir-ho a un array.
        //el que fa es agafar el valor a partir d'una clau.
        // ho passem a array i ho mostrem.
        // + info README
        $task_names = $tasks->pluck('name')->toArray();
        $task_name = $this->choice('Task id?', $task_names);

        return $tasks->where('name', $task_name)->first()->id;
    }
}
