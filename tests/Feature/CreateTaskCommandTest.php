<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Mockery;
use Tests\TestCase;

class CreateTaskCommandTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @test
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        //   App::setLocale('en');
        //$this->withoutExceptionHandling();
    }

    public function testItCreatesNewTask()
    {

        //prepare

        //run
        $this->artisan('task:create', ['name' => 'Comprar pa']);

        $resultAsText = artisan::output();

        $this->assertDatabaseHas('tasks', ['name'=>'Comprar pa']);

//        $this->assertTrue(str_contains($resultAsText, 'Task has been added to database succesfully'));
        $this->assertContains('Task has been added to database succesfully', $resultAsText);
    }

    public function testItAsksForATaskNameAndThenCreateNewTask()
    {

        // 1) Prepare

        $command = Mockery::mock('App\Console\Commands\CreateTaskCommand[ask]');

        $command->shouldReceive('ask')
                ->once()
                ->with('Event name?')
                ->andReturn('Comprar llet');

        $this->app['Illuminate\Contracts\Console\Kernel']->registerCommand($command);

        // 2) Execució
        $this->artisan('task:create');

        $this->assertDatabaseHas('tasks', ['name' => 'Comprar llet']);
        // 3) Assert
        $resultAsText = artisan::output();

        $this->assertContains('Task has been added to database succesfully', $resultAsText);
    }
}
