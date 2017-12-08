<?php

namespace Tests\Feature;

use App\Task;
use App\User;
use Illuminate\Support\Facades\View;
use function Sodium\crypto_box_publickey_from_secretkey;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
        initialize_task_permissions();
        //$this->withoutExceptionHandling();
    }


    public function loginAsTaskManager()
    {
        $user = factory(User::class)->create();

       $user->assignRole('task-manager');
        $this->actingAs($user);

        View::share('user',$user);

    }

    /**
     * @test
     */
    public function listTaskAsTaskManager()
    {
        $this->loginAsTaskManager();

        $tasks = factory(Task::class, 2)->create();

        $response = $this->get('/tasks_php');

        $response->assertSuccessful();
        $response->assertSeeText('Tasks PHP');
        foreach ($tasks as $task) {
            $response->assertSeeText($task->name);
        }
    }

    /**
     * @test
     */
    public function listTasksErrorLogged()
    {
        factory(Task::class, 2)->create();

        $response = $this->get('/tasks_php');
        $response->assertRedirect('login');

    }

    /**
     * @test
     */
    public function showAtask()
    {
        $task = factory(Task::class)->create();

        $this->loginAsTaskManager();

        $response = $this->get("/tasks_php/$task->id");

        $response->assertSuccessful();

        $response->assertViewIs('show_task');

        $response->assertSeeText('Show PHP');

        $response->assertSeeText($task->name);
    }

    /**
     * @test
     */
    public function showCreateTask()
    {
        
        $this->loginAsTaskManager();


        factory(User::class, 5)->create();

        $response = $this->get('/tasks_php/create');
        $response->assertSuccessful();
        $response->assertViewIs('create_task');

        $users = User::all();
        $response->assertViewHas('users', $users);

        $response->assertSeeText('Create Task:');


    }

    /**
     * @test
     */
    public function storeAtask()
    {
        $this->loginAsTaskManager();

        $user = factory(User::class)->create();
        $response = $this->post('/tasks_php', [
            'name'        => 'Prova prova',
            'description' => 'descrip',
            'user_id'     => $user->id,
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('tasks', [
            'name'        => 'Prova prova',
            'description' => 'descrip',
            'user_id'     => $user->id,
        ]);


    }

    /**
     * @test
     */
    public function destroyTask()
    {
        $this->loginAsTaskManager();

        $task = factory(Task::class)->create();

        $response = $this->delete('tasks_php/'.$task->id);

        $this->assertDatabaseMissing('tasks',[
            'name' => $task->name,
            'description'=>$task->description
            ]);

        $response->assertRedirect('tasks_php');

    }


}
