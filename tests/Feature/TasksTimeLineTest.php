<?php

namespace Tests\Feature;

use App\Task;
use App\TaskEvent;
use App\User;
use stdClass;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksTimeLineTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic test example.
     * @test
     *
     */
    public function test_timeline_tasks()
    {
    $this->withoutExceptionHandling();
        //Preparació

        $user = Factory(User::class)->create();
        $this->actingAs($user);

        //create tasks
        $task = Task::create([
           'name' => 'Comprar pa',
            'completed' => true,
            'user_id' => $user->id
        ]);

        //RETRIEVE
        $task2 = Task::find($task->id);

        //UPDATE TASK

        $task->update([
            'name' => 'Comprar oli'

        ]);


        //DELETE TASK

        $task->delete();
        //Execució

        $task_events = TaskEvent::all();


        //Hi ha dos interficies de comunicació: Via API i via WEB

        //comprovació


        $response = $this->get('/tasks/timeline');

        $response->assertSuccessful();
        $response->assertViewIs('timeline');
        $response->assertViewHas('task_events', $task_events);

//        $response->assertSee("User " . $user->name . " created task " . $task->name . " at " . $task->created_at);
//        $response->assertSee("User " . $user->name . " retrieved task " . $task->name . " at ");
//        $response->assertSee("User " . $user->name . " updated task " . $task->name . " at "); //PAYLOAD: informar del nom anterior i el nom actualitzat.
//        $response->assertSee("User " . $user->name . " deleted task " . $task->name . " at ");






    }
}
