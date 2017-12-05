<?php

namespace Tests\Feature;

use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Mockery;
use Tests\TestCase;

class DestroyTaskCommandTest extends TestCase
{
    /*
     * A basic test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testItDestroyTask()
    {
        $task = factory(Task::class)->create();
        $this->artisan('task:destroy', ['id'=>$task->id]);

        $resultAsText = Artisan::output();

        //missing el que fa es veure si existeix a la table, el camp amb el valor passat.
        $this->assertDatabaseMissing('tasks', ['id'=>'12']);

        $this->assertContains('Task has been deleted to database succesfully', $resultAsText);
    }

    public function testItAsksForAtaskIdAndThenDeleteTask()
    {
        $task = factory(Task::class)->create();

        $command = Mockery::mock('App\Console\Commands\DestroyTaskCommand[ask]');

        $command->shouldReceive('ask')
          ->once()
          ->with('Event id?')
          ->andReturn('1');

        $this->app['Illuminate\Contracts\Console\Kernel']->registerCommand($command);

        $this->artisan('task:destroy');

        //missing el que fa es veure si existeix a la table, el camp amb el valor passat.
        $this->assertDatabaseMissing('tasks', ['id'=>$task->id, 'name'=> $task->name]);
        $resultAsText = Artisan::output();

        $this->assertContains('Task has been deleted to database succesfully', $resultAsText);
    }
}
