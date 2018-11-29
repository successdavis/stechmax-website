<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadThreadTest extends TestCase
{
    use DatabaseMigrations;
    
    public function setUp()
    {
        parent::setUp();

        $this->threads = factory('App\Thread')->create();
    }

    /** @test */
    public function a_user_can_browse_all_threads()
    {

        $this->get('/threads')
            ->assertSee($this->threads->title);
    }

    /** @test */
    public function a_user_can_read_a_single_thread()
    {
        $this->get($this->threads->path())
            ->assertSee($this->threads->title);
    }

    /** @test */
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $reply = factory('App\Reply')->create(['thread_id' => $this->threads->id]);
        // When
        $this->get($this->threads->path() )
            ->assertSee($reply->body);
    }
}
