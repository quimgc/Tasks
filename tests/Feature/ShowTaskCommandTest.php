<?php

namespace Tests\Feature;

use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ShowTaskCommandTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function showTask()
    {
        //PREPARE

        $task = factory(Task::class)->create();

        //executo
        $this->artisan('task:show', ['id' => $task->id]);

        //guardo resultat
        $result = Artisan::output();

        //comprovo els resultats

        $this->assertContains('id', $result);
        //s'ha de fer un casting per passar l'id a String per poder comparar-ho
        $this->assertContains((string) $task->id, $result);

        $this->assertContains('Name', $result);
        $this->assertContains($task->name, $result);

        $this->assertContains('User_id', $result);
        $this->assertContains((string) $task->user_id, $result);

        $this->assertContains('Description', $result);
        $this->assertContains($task->description, $result);
    }

    //Show a Task with Wizard
}
