<?php

namespace App\Observers;

use App\Task;
use App\TaskEvent;
use App\User;
use Carbon\Carbon;

/**
 * Created by PhpStorm.
 * User: quim
 * Date: 15/02/18
 * Time: 21:13
 */

class TaskObserver{


    /**
     * @param Task $task
     */
    public function created(Task $task)
    {

        TaskEvent::create([

            'time' => Carbon::now(),
            'type' => 'created',
            'task_name' => $task->name,
            'user_name' => $task->user->name,
            'task' => json_encode($task)


        ]);

    }

    public function updated(Task $task)
    {
        TaskEvent::create([
            'time' => Carbon::now(),
            'task_name' => $task->name,
            'user_name' => User::findOrFail($task->user_id)->name,
            'type' => 'updated',
            'task' => json_encode($task)
        ]);
    }

    public function saved(Task $task)
    {
        TaskEvent::create([
            'time' => Carbon::now(),
            'task_name' => $task->name,
            'user_name' => User::findOrFail($task->user_id)->name,
            'type' => 'saved',
            'task' => json_encode($task)
        ]);
    }

    public function deleted(Task $task)
    {
        TaskEvent::create([
            'time' => Carbon::now(),
            'task_name' => $task->name,
            'user_name' => User::findOrFail($task->user_id)->name,
            'type' => 'deleted',
            'task' => json_encode($task)

        ]);
    }
}