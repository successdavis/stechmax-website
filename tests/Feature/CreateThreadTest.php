<?php

namespace Tests\Feature;

use App\Thread;
use App\Activity;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateThreadTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function an_authenticated_user_can_create_a_new_thread()
    {
        $this->signIn();
        $thread = make('App\Thread');

        $response = $this->post('/threads', $thread->toArray());
        
        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /** @test */
    public function new_users_must_first_confirm_their_email_address_before_creating_threads()
    {
        $user = factory('App\User')->states('unconfirmed')->create();

        $this->signIn($user);

        $thread = make('App\Thread');

        $this->post(route('threads'), $thread->toArray())
            ->assertRedirect(route('register.confirm_email'))
            ->assertSessionHas('flash', 'You must first confirm your email addresss');
    }

    /** @test */
    public function guest_may_not_create_thread()
    {
       $this->withExceptionHandling()
        ->post(route('threads'))
        ->assertRedirect(route('login'));
    }

    /** @test */
    public function a_thread_requires_a_title()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_thread_requires_a_body()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function a_thread_requires_a_valid_channel_id()
    {
        factory('App\Channel', 2)->create();

        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');
        
        $this->publishThread(['channel_id' => 999])
            ->assertSessionHasErrors('channel_id');
    }

    /** @test */
    public function a_thread_requires_a_unique_slug()
    {

        $this->signIn();

        $thread = create('App\Thread', ['title' => 'Foo Title']);

        $this->assertEquals($thread->fresh()->slug, 'foo-title');

        $thread = $this->postJson(route('threads'), $thread->toArray())->json();

        $this->assertEquals("foo-title-{$thread['id']}", $thread['slug']);

    }

    /** @test */
    public function a_thread_with_a_title_that_ends_in_a_number_should_generate_the_proper_slug()
    {
        $this->signIn();

        $thread = create('App\Thread', ['title' => 'Some Title 24']);

        $thread = $this->postJson(route('threads'), $thread->toArray())->json();

        $this->assertEquals("some-title-24-{$thread['id']}", $thread['slug']);
       
    }

    /** @test */
    function unauthorized_users_may_not_delete_threads()
    {
        $this->withExceptionHandling();

        $thread = create('App\Thread');

        $this->delete($thread->path())->assertRedirect(route('login'));

        $this->signIn();
        $this->delete($thread->path())->assertStatus(403);
    }

    /** @test */
    function authorized_users_can_delete_threads()
    {
        $this->signIn();

        $thread = create('App\Thread', ['user_id' => auth()->id()]);
        $reply = create('App\Reply', ['thread_id' => $thread->id]);

        $response = $this->json('DELETE', $thread->path());

        $response->assertStatus(204);

        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
        $this->assertDatabaseMissing(
            'activities', [
                'subject_id' => $thread->id,
                'subject_type' => get_class($thread)
            
        ]);

        $this->assertDatabaseMissing(
            'activities', [
                'subject_id' => $reply->id,
                'subject_type' => get_class($reply)
            ]
        );

        $this->assertEquals(0, Activity::count());
    }

    public function publishThread($overrides = [])
    {
        $this->withExceptionHandling()->signIn();

        $thread = make('App\Thread', $overrides);

        return $this->post('/threads', $thread->toArray());

    }

}




