<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ReadUserTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = create('App\User');
    }

    /** @test */
    public function an_admin_can_search_through_users()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());
        $user = create('App\User', ['f_name' => 'john']);
        $usertwo = create('App\User', ['f_name' => 'Sherry result result']);

        $url = 'dashboard/users/datatable?search=john&column=f_name&order=asc';

        $users = $this->json('GET', $url)->json();

        $this->assertCount(1, $users['data']);
    }
}
