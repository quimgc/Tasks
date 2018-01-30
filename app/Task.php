<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name', 'user_id', 'description', 'completed'];

    public function toArray()
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'user_id'     => $this->user_id,
//            'completed' => (Boolean) $this->completed, aquesta linia fa el mateix que la següent.
            'completed'  => $this->completed ? true : false,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
