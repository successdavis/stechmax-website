<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateSubjectTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function administrator_may_create_new_channel()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());

        $channel = make('App\Subject');

        $this->post('/subjects', $channel->toArray())
            ->assertStatus(200);
    }

    /** @test */
    public function non_administrator_may_not_create_new_subject()
    {
        $this->withExceptionHandling();
        $this->signIn();

        $channel = make('App\Subject');

        $this->post('/subjects', $channel->toArray())
            ->assertStatus(403);
    }

    /** @test */
    public function a_subject_requires_a_name()
    {
        $this->withExceptionHandling();

        $this->signIn(factory('App\User')->states('administrator')->create());

        $subject = make('App\Subject', ['name' => null]);

        $this->post(route('subjects.new'), $subject->toArray())
            ->assertSessionHasErrors('name');
    }
}
