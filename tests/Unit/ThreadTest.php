<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;
    public function setUp()
    {
        parent::setUp();

        $this->thread = create('App\Thread');
    }
    /** @test */
    public function a_thread_has_replies()
    {
        $thread = create('App\Thread');

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $thread->replies);   
    }

    /** @test */
    public function a_thread_has_a_creator()
    {
        $thread = create('App\Thread');

        $this->assertInstanceOf('App\User', $thread->creator);
    }

    /** @test */
    public function a_thread_can_add_a_reply()
    {
        $this->thread->addReply([
            'body' => 'Foobar',
            'user_id' => 1
        ]);

        $this->assertCount(1, $this->thread->replies);
    }

     /** @test */
    public function it_belongs_to_a_channel()
    {
        $thread = create('App\Thread');

        $this->assertInstanceOf('App\Channel', $thread->channel);        
    }

    /** @test */
    public function it_can_generate_a_string_path()
    {
        $thread = create('App\Thread');
        $this->assertEquals("/threads/{$thread->channel->slug}/{$thread->id}", $thread->path());
    }

    /** @test */
    public function a_thread_can_be_subscribed_to()
    {                                                                                            
        $thread = create('App\Thread');

        $thread->subscribe($userId = 1);

        $this->assertEquals(
            1,
            $thread->subscriptions()->where('user_id', $userId)->count()
        );
    }

    /** @test */
    public function a_thread_can_be_unsubscribe_from()
    {
        $thread = create('App\Thread');

        $thread->subscribe($userId = 1);

        $thread->unsubscribe($userId);

        $this->assertCount(0, $thread->subscriptions);
    }

    /** @test */
    public function it_knows_if_the_authenticated_user_is_subscribed_to_it()
    {
        $thread = create('App\Thread');

        $this->signIn();

        $this->assertFalse($thread->isSubscribedTo);

        $thread->subscribe();

        $this->assertTrue($thread->isSubscribedTo);
    }

}
