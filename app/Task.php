<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name', 'user_id', 'description'];

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'user_id' => $this->user_id,
            'completed' => $this->completed? true:false,
            'created_at' => $this->created_at."",
            'updated_at' => $this->updated_at."",
        ];
    }
}
