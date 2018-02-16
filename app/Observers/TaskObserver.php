<?php

namespace App\Observers;

use App\Task;
use App\TaskEvent;
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


        ]);



    }

    /**
     * @param User $task
     */
    public function retrieved(Task $task)
    {

    }


    public function updated (Task $task)
    {

    }
}