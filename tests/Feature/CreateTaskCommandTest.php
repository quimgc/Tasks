<?php

namespace Tests\Feature;

use App\User;
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
        initialize_task_permissions();

        //   App::setLocale('en');
        //$this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function testItCreatesNewTask()
    {

        //prepare

        //run
        $user = factory(User::class)->create();
        $this->artisan('task:create', ['name' => 'Comprar pa', 'user_id' => $user->id]);

        $resultAsText = artisan::output();

        $this->assertDatabaseHas('tasks', ['name'=>'Comprar pa', 'user_id' => $user->id]);

//        $this->assertTrue(str_contains($resultAsText, 'Task has been added to database succesfully'));
        $this->assertContains('Task has been added to database succesfully', $resultAsText);
    }

    /**
     * @test
     */
    public function testItAsksForATaskNameAndThenCreateNewTask()
    {

        // 1) Prepare

        $command = Mockery::mock('App\Console\Commands\CreateTaskCommand[ask]');

        $command->shouldReceive('ask')
            ->once()
            ->with('Task name?')
            ->andReturn('Comprar llet');
        $command->shouldReceive('ask')
            ->once()
            ->with('User id?')
            ->andReturn('1');

        $this->app['Illuminate\Contracts\Console\Kernel']->registerCommand($command);

        // 2) Execució
        $this->artisan('task:create');

        $this->assertDatabaseHas('tasks', ['name' => 'Comprar llet', 'user_id'=>'1']);
        // 3) Assert
        $resultAsText = artisan::output();

        $this->assertContains('Task has been added to database succesfully', $resultAsText);
    }
}
