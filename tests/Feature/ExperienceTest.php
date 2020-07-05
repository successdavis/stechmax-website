<?php

namespace Tests\Feature;

use App\Events\UserEarnedExperience;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;


class ExperienceTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = create('App\User');
    }

    /** @test */
    public function an_annoucement_is_made_when_experience_is_awarded()
    {
    	Event::fake();

    	$this->signIn();

        $this->user->awardExperience(400,'Best Performing Student');

    	Event::assertDispatched(UserEarnedExperience::class);	
    }

    /** @test */
    public function an_admin_can_award_experience_point_to_a_user()
    {
    	$this->signIn(factory('App\User')->states('administrator')->create());

    	$this->json('POST', 'api/'. $this->user->username .'/awardexperience', ['points' => 300,'description' => 'Assignment Completed'])
    		->assertStatus(200);
    	$this->assertEquals(300, $this->user->fresh()->experienceLevel());
    }

    /** @test */
    public function a_non_administrator_cannot_award_experience_point_to_a_user()
    {
    	$this->withExceptionHandling();
    	$this->json('POST', 'api/'. $this->user->username .'/awardexperience', ['points' => 300])
    		->assertStatus(403);
    }

    /** @test */
    public function a_user_earns_experience_when_they_subscribe_to_lesson()
    {
    	$this->signIn($this->user);
    	$invoice = create('App\Invoice');
        $course = create('App\Course');

    	$course->createSubscription('',$invoice->id);

    	$this->assertEquals(100, $this->user->experienceLevel());
    }

    /** @test */
    public function a_user_earns_experience_when_they_post_a_thread()
    {
        $this->signIn($this->user);
        $thread = make('App\Thread');

        $response = $this->post('/threads', $thread->toArray());

        $this->assertEquals(10, $this->user->experienceLevel());
    }

    /** @test */
    public function a_user_earns_experience_when_they_reply_to_a_thread()
    {
        $this->signIn($this->user);
        $thread = create('App\Thread');

        $reply = $thread->addReply([
                'body'      => 'some dummy text',
                'user_id'   => auth()->id()
            ]);

        $this->assertEquals(5, $this->user->experienceLevel());
    }

    /** @test */
    public function experience_is_awarded_to_best_reply_user()
    {
        $this->signIn();

        $thread = create('App\Thread', ['user_id' => auth()->id()]);
        $reply = create('App\Reply', ['thread_id' => $thread->id, 'user_id' => $this->user->id]);

        $this->postJson(route('best-replies.store', [$reply->id]));

        $this->assertEquals(10, $this->user->experienceLevel());

    }
}
