<?php

namespace Tests\Feature;

use App\Task;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditTaskCommandTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function editTask()
    {
        $task = factory(Task::class)->create();

        //modifico
        $this->artisan('task:edit',['id'=>$task->id,'name'=>'canvi de nom', 'user_id' => $task->id, 'description'=> 'descripció nova']);

        $resultAsText = Artisan::output();

        $this->assertDatabaseHas('tasks',[

            'id' => $task->id,
            'name' => 'canvi de nom',
            'description' => 'descripció nova',
            'user_id' => $task->user_id,

        ]);

        $this->assertDatabaseMissing('tasks',[

            'id' => $task->id,
            'name' => $task->name,
            'description' => $task->description,
            'user_id' => $task->user_id,

        ]);

        $this->assertContains('Task has been edited succesfully',$resultAsText);
    }
}
