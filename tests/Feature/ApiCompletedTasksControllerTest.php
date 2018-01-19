<?php

namespace Tests\Feature;

use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class APIAttendedEventControllerTest.
 */
class ApiCompletedTasksControllerTest extends TestCase
{
    use RefreshDatabase;

    const MANAGER = 'task-manager';

    /**
     * Set up tests.
     */
    public function setUp()
    {
        parent::setUp();
        initialize_task_permissions();
        $this->withoutExceptionHandling();
    }

    /**
     * Login as tasks manager.
     *
     * @param $user
     */
    protected function loginAndAuthorize()
    {
        $user = factory(User::class)->create();
        $user->assignRole('task-manager');
        $this->actingAs($user, 'api');

        return $user;
    }

    /**
     * Store.
     *
     * @test
     */
    public function store()
    {
        $this->loginAndAuthorize();
        $task = factory(Task::class)->create();

        $response = $this->json('POST', '/api/v1/completed-tasks/'.$task->id);

        $response->assertSuccessful();

        $this->assertDatabaseHas('tasks', [
            'id'          => $task->id,
            'name'        => $task->name,
            'completed'   => true,
            'description' => $task->description,
            'user_id'     => $task->user->id,
        ]);

        $response->assertJson([
            'id'          => $task->id,
            'name'        => $task->name,
            'completed'   => true,
            'description' => $task->description,
            'user_id'     => $task->user->id,
        ]);
    }

    /**
     * Destroy.
     *
     * @test
     */
    protected function destroy()
    {
        $user = factory(User::class)->create();
        $this->loginAsManager($user, 'api');

        $task = factory(Task::class)->create();

        $response = $this->json('DELETE', '/api/v1/completed-tasks/'.$task->id);

        $response->assertSuccessful();

        $this->assertDatabaseHas('tasks', [
            'id'          => $task->id,
            'name'        => $task->name,
            'completed'   => false,
            'description' => $task->description,
            'user_id'     => $task->user->id,
        ]);

        $response->assertJson([
            'id'          => $task->id,
            'name'        => $task->name,
            'completed'   => false,
            'description' => $task->description,
            'user_id'     => $task->user->id,
        ]);

        $response->assertJson([
            'id'   => $task->id,
            'name' => $task->name,
        ]);
    }
}
