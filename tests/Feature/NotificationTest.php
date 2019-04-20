<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NotificationTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->signIn();
    }
    
    /** @test */
    public function a_notification_is_prepared_when_a_subscribe_thread_receives_a_new_reply_that_is_not_by_the_current_user()
    {
        $thread = create('App\Thread')->subscribe();
        // there should be zero notification for the user on this thread
        $this->assertCount(0, auth()->user()->notifications);

        // and each time a reply is left on this thread the the signed in user
        $thread->addReply([
            'user_id' => auth()->id(),
            'body' => 'Some reply here'
        ]);
        
        // the user should not receie any notification  
        $this->assertCount(0, auth()->user()->fresh()->notifications);

        // but if this reply is added by somebody else 
        $thread->addReply([
            'user_id' => create('App\User')->id,
            'body' => 'Some reply here'
        ]);

        $this->assertCount(1, auth()->user()->fresh()->notifications);
    }

    /** @test */
    public function a_user_can_fetch_their_unread_notifications()
    {
        create(DatabaseNotification::class);

       $this->assertCount(
            1, 
            $this->getJson("/profiles/" . auth()->user()->username . "/notifications")->json());
    }

    /** @test */
    public function a_user_can_mark_a_notification_as_read()
    {
        create(DatabaseNotification::class);

        tap(auth()->user(), function($user) {
            $this->assertCount(1, $user->unreadNotifications);

            $this->delete("/profiles/{$user->username}/notifications/" . $user->unreadNotifications->first()->id);

            $this->assertCount(0, $user->fresh()->unreadNotifications);
        });
    }
}
