<?php

namespace Tests\Feature;

use App\Task;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class APIAuthorizedURLsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Set up tests.
     */
    public function setUp()
    {
        parent::setUp();
        $user = factory(User::class)->create();
        factory(User::class)->create();
        factory(Task::class)->create();
        initialize_task_permissions();
        $this->actingAs( $user,'api');
//        $this->withoutExceptionHandling();
    }

    /**
     * Authorizated URIs provider.
     *
     * @return array
     */
    public function authorizatedURIs()
    {
        return [
            ['get','/api/v1/events'],
            ['get','/api/v1/events/1'],
            ['post','/api/v1/events'],
            ['put','/api/v1/events/1'],
            ['delete','/api/v1/events/1'],
            ['get','/api/v1/users'],
            ['get','/api/v1/users/2'],
            ['post','/api/v1/users'],
            ['put','/api/v1/users/2'],
            ['delete','/api/v1/users/2'],
        ];
    }

    /**
     * URI requires authorizated user.
     *
     * @test
     * @dataProvider authorizatedURIs
     */
    public function uri_requires_authorizated_user($method , $uri)
    {
        $response = $this->json($method, $uri);
        $response->assertStatus(403);
    }
}
