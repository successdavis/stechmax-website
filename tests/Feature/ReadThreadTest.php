<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadThreadTest extends TestCase
{
    use DatabaseMigrations;
    
    public function setUp(): void
    {
        parent::setUp();

        $this->threads = create('App\Thread');
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
    public function a_user_can_browse_threads_by_channel()
    {
        $channel = create('App\Channel');
        $threadInChannel = create('App\Thread', ['channel_id' => $channel->id]);
        $threadNotInChannel = create('App\Thread');

        $this->get('/threads/'. $channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel);
    }

    /** @test */
    public function a_user_can_filter_thread_by_any_user_name()
    {
        $this->signIn(create('App\User', ['f_name' => 'John', 'l_name' => 'Doe']));
        $threadByJohn = create('App\Thread', ['user_id' => auth()->id()]);
        $threadNotByJohn = create('App\Thread');

        $this->get('threads?by=' . auth()->user()->email)
            ->assertSee($threadByJohn->title)
            ->assertDontSee($threadNotByJohn->title);
    }

    // /** @test */
    // public function a_user_can_filter_threads_by_those_that_are_unaswered()
    // {
    //     $thread = create('App\Thread');
    //     create('App\Reply', ['thread_id' => $thread->id]);

    //     $response = $this->getJson('threads?unanswered=2')->json();

            // $this->assertCount(1, $response['data']);
    // }

    /** @test */
    public function a_user_can_request_all_reply_for_a_given_thread()
    {
        $thread = create('App\Thread');
        create('App\Reply', ['thread_id' => $thread->id], 2);
        
        $response = $this->getJson($thread->path() . '/replies')->json();

        $this->assertCount(2, $response['data']);
        $this->assertEquals(2, $response['total']);
    }

    /** @test */
    public function it_record_a_new_visit_each_time_the_thread_is_read()
    {
        $thread = create('App\Thread');

        $this->assertSame(0, $thread->visits);

        $this->call('GET', $thread->path());

        $this->assertEquals(1, $thread->fresh()->visits);
    }

    /** @test */
    public function a_user_can_search_through_threads()
    {
        $thread = create('App\Thread', ['title' => 'some search keywords']);
        $threadtwo = create('App\Thread', ['title' => 'does not contain result result']);

        $url = 'threads?search=search keywords';

        $threads = $this->json('GET', $url)->json();

        $this->assertCount(1, $threads['data']);  
    }
}
