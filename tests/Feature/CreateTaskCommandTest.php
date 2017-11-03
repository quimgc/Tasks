<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTaskCommandTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testItCreatesNewTask()
    {

        //prepare

        //run

        $this->artisan('task:create', ['name' => 'Comprar pa']);

        $resultAsText = artisan::output();

        $this->assertDatabaseHas('tasks',['name'=>'Comprar pa']);

//        $this->assertTrue(str_contains($resultAsText, 'Task has been added to database succesfully'));
        $this->assertContains('Task has been added to database succesfully', $resultAsText);

    }


    public function testItAsksForATaskNameAndThenCreateNewTask(){

        // 1) Prepare

        // 2) Execució
        $this->artisan('task:create');


        // 3) Assert
        $resultAsText = artisan::output();

        $this->assertContains('Task has been added to database succesfully', $resultAsText);

    }

}
