<?php

namespace Tests\Feature;

use App\User;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiUsersControllerTest extends TestCase
{
use RefreshDatabase;

    /**
     * Set up tests.
     *
     */
    public function setUp()
    {
        parent::setUp();
     //   App::setLocale('en');
       //$this->withoutExceptionHandling();
    }

    public function can_list_users()
    {
        $users = factory(Task::class,4)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->json('GET','/api/v1/users');

        $response->assertSuccessful();

        $response->assertJsonStructure([[
            'id',
            'name',
            'created_at',
            'updated_at'
        ]]);

    }
    
      public function can_show_a_user()
    {
        $user = factory(User::class)->create();
        $loggedUser = factory(User::class)->create();
        $this->actingAs($loggedUser);
        $response = $this->json('GET', '/api/v1/users/' . $user->id);
        $response->assertSuccessful();
        $response->assertJson([
            'id' => $user->id,
            'name' => $user->name
        ]);
    }

    /**
     * @test
     */
    public function cannot_add_user_if_no_name_provided()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        //EXECUTE

        $response = $this->json('POST','/api/v1/users');

        //Assert
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function cannot_add_user_if_not_logged()
    {
        $faker = Factory::create();

        //EXECUTE

        $response = $this->json('POST','/api/v1/users',[
            'name' => $name = $faker->word
        ]);

        //Assert
        $response->assertStatus(401);
    }
    

    /**
     * @test
     */
    public function can_add_a_user()
    {
        //PREPARE
        $faker = Factory::create();
        $user = factory(User::class)->create();

        $this->actingAs($user);
        //EXECUTE

        $response = $this->json('POST','/api/v1/users',[
            'name' => $name = $faker->word
        ]);

        //ASSERT

        $response->assertSuccessful();

        $this->assertDatabaseHas('users', [
           'name' => $name
        ]);

        $response->assertJson([
           'name'=>$name
        ]);
    }

    /**
     * @test
     */
    /**
     * @test
     */
    public function can_delete_user()
    {
        $user = factory(Task::class)->create();
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->json('DELETE','/api/v1/users/' . $user->id);

        $response->assertSuccessful();

        $this->assertDatabaseMissing('users',[
            'id' =>  $user->id,
            'name' => $user->name
        ]);
    }

    /**
     * @test
     */
    public function cannot_delete_unexisting_user()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->json('DELETE','/api/v1/users');

        $response->assertStatus(404);
    }


    /**
     * @test
     */
    public function can_edit_user()
    {
        // PREPARE
        $user = Factory(Task::class)->create();

        $user = factory(User::class)->create();
        $this->actingAs($user);

        // EXECUTE
        $response = $this->json('PUT', '/api/v1/users/' . $user->id, [
            'name' => $newName = 'NOU NOM'
        ]);

        // ASSERT
        $response->assertSuccessful();

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $newName
        ]);

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'name' => $user->name,
        ]);

        $this->assertDatabaseMissing('users',[
            'id' =>  $user->id,
            'name' => $newName
        ]);
    }

}
