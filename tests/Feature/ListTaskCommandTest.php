<?php

namespace Tests\Feature;

use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ListTaskCommandTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function listTask()
    {

        //prepare
        $tasks = factory(Task::class, 3)->create();

        //executo
        $this->artisan('task:list');

        $resultAsText = Artisan::output();

        //comprovo

        foreach ($tasks as $task) {
            $this->assertContains((string) $task->id, $resultAsText);
            $this->assertContains($task->name, $resultAsText);
            $this->assertContains((string) $task->descripion, $resultAsText);
            $this->assertContains((string) $task->user_id, $resultAsText);
            $this->assertContains((string) $task->created_at, $resultAsText);
            $this->assertContains((string) $task->updated_at, $resultAsText);
        }
    }
}
