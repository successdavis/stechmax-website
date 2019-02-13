<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SubscribeToThreadsTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function a_user_can_subscribe_to_threads()
    {
        //Given we have a signedIn User
        $this->signIn();

        // and we have a thread
        $thread = create('App\Thread');
        
        // when the user subscribes to the given thread
        $this->post($thread->path() . '/subscriptions');

        $this->assertCount(1, $thread->fresh()->subscriptions);
        
    }

    /** @test */
        public function a_user_can_unscribe_from_threads()
        {
            //Given we have a signedIn User
            $this->signIn();

            // and we have a thread
            $thread = create('App\Thread');
            
            // and this user is subscribe to the thread 
            $thread->subscribe();

            //when the user request to unsubscribe from this thread
            $this->delete($thread->path() . '/subscriptions');

            // then the user should be unsubscribe from the thread
            $this->assertCount(0, $thread->subscriptions);

        }    
}
