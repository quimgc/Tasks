<?php

namespace Tests\Browser;

use App\Task;
use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class PHPTasksTest.
 *
 * @package Tests\Browser
 */
class PHPTasksTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Set up tests.
     */
    public function setUp()
    {
        parent::setUp();
        initialize_task_permissions();
//        Artisan::call('passport:install');
//        $this->withoutExceptionHandling();
    }

    /**
     * @return mixed
     */
    protected function loginAndAuthorize($browser)
    {
        $user = factory(User::class)->create();
        $user->assignRole('task-manager');
        $browser->loginAs($user);

        return $user;
    }

    /**
     * List tasks.
     *
     * @test
     * @return void
     */
    public function list_tasks()
    {
        $this->browse(function (Browser $browser)  {
            $tasks = factory(Task::class, 3)->create();
            $browser->maximize();
//            $browser->resize(1920, 1080);
            $this->loginAndAuthorize($browser);

            $browser->visit('/tasks_php');
            $browser->assertTitleContains('Tasks PHP');
            //don't see alert message (only show when errors or ok messages)
            $browser->assertMissing('.alert');
            $browser->assertSeeLink('Create Task');


            foreach ($tasks as $task) {
                $browser->assertSee($task->id);
                $browser->assertSee($task->user_id);
                $browser->assertSee($task->name);
                $browser->assertSee($task->description);
                $browser->assertVisible('#show-task-' . $task->id);
                $this->assertContains('Show',$browser->text('#show-task-' . $task->id));
                $browser->assertVisible('#edit-task-' . $task->id);
                $this->assertContains('Edit',$browser->text('#edit-task-' . $task->id));
                $browser->assertVisible('#delete-task-' . $task->id);
                $this->assertContains('Delete',$browser->text('#delete-task-' . $task->id));
            }

            $browser->assertVisible('table');
            $browser->pause(5000);
        });
    }

    /**
     * Create tasks.
     *
     * @test
     * @return void
     */
    public function create_task()
    {
        $this->browse(function (Browser $browser) {
            $browser->maximize();

            $this->loginAndAuthorize($browser);

            $browser->visit('/tasks_php');

            $browser->assertSeeLink('Create Task');
            $browser->clickLink('Create Task');
            $browser->assertMissing('.alert');
            //Test back button
            $browser->assertSeeLink('Back');
            $browser->clickLink('Back');
            $browser->clickLink('Create Task');

            // See create task box
            $browser->assertVisible('.box');
            //see form in box body
            $browser->assertVisible('.box form');

            //Assert see input for task name
            $browser->assertVisible('.box form input[name=name]');
            //assert see input for task description
            $browser->assertVisible('.box form input[name=description]');

            // Assert see select/dropdown for user
            $browser->assertVisible('.box form select[name=user_id]');


//            $browser->pause(500000);

            //See box footer
            $browser->assertVisible('.box .box-footer');
            $this->assertContains('Create', $browser->text('.box .box-footer'));

            //Test validation
            $browser->press('Create');
            $browser->waitFor('.alert');
            $browser->waitForText('The name field is required.');

            //Create task
            $browser->type('name', 'Buy bread');
            $browser->type('description',"for lunch");
            //Select a random user in users dropdown
            $browser->select('user_id');
            $browser->press('Create');

            $browser->waitFor('.alert');
            $browser->waitForText('Created ok!');
            $browser->assertSee('Created ok!');
            $browser->assertSee("Buy bread");
            $browser->assertSee("for lunch");


        });
    }

    /**
     * Show task.
     * @group current
     * @test
     * @return void
     */
    public function show_task()
    {
        $this->browse(function (Browser $browser) {
            $tasks = factory(Task::class, 3)->create();

            $this->loginAndAuthorize($browser);

            $browser->visit('/tasks_php');

            $browser->click('#show-task-1');
//            $browser->pause(500000);

            //Test back button
            $browser->assertSeeLink('Back');
            $browser->clickLink('Back');
            $browser->click('#show-task-1');

            //Test edit button
            $browser->assertSeeLink('Edit');
            $browser->clickLink('Edit');
//            $browser->click('#show-task-1');

            $browser->assertPathIs("/tasks_php/edit/1");
            $browser->assertSeeLink("Back");
            $browser->clickLink("Back");
            $browser->assertPathIs("/tasks_php");
        //$browser->pause(3000);

            //Test delete button
            $browser->assertSee("Delete");
            $browser->press('Delete');
            $browser->assertMissing("#show-task-1");

        });
    }

    /**
     * @group prova
     * @test
     */
    public function edit_task()
    {
        $this->browse(function (Browser $browser) {
            $tasks = factory(Task::class, 3)->create();

            $this->loginAndAuthorize($browser);

            $browser->visit('/tasks_php');
            $browser->assertSee($tasks[0]->id);
            $browser->assertSeeLink("Edit");
            $browser->click("#edit-task-1");

            $browser->assertPathIs("/tasks_php/edit/1");

            $value = $browser->value('@name');


        });
        }
}
