<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class TaskEvent extends model
{
    protected $guarded = [];

    public function toArray()
    {
        return [
            'id'          => $this->id,
            'time'        => $this->time,
            'type'        => $this->type,
            'task_name'        => $this->task_name,
            'user_name'        => $this->user_name,
        ];
    }
}