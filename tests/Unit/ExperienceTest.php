<?php

namespace Tests\Unit;

use App\Course;
use App\Events\UserEarnedExperience;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class ExperienceTest extends TestCase
{
    use DatabaseMigrations;
    
    public function setUp()
    {
        parent::setUp();

        $this->user = create('App\User');
    }

    /** @test */
    public function an_annoucement_is_made_when_experience_is_awarded()
    {
    	Event::fake();

    	$this->signIn();

    	$invoice = create('App\Invoice', ['user_id' => $this->user->id]);
    	$course = Course::find(1);

    	$subscription = $course->createSubscription($this->user->id, $invoice->id);

    	Event::assertDispatched(UserEarnedExperience::class);

    	
    }

    /** @test */
    public function a_user_earns_experience_when_they_subscribe_to_lesson()
    {
    	$this->signIn();
    	$invoice = create('App\Invoice');

    	$this->user->createSubscription('',$invoice->id);

    	$this->assertEquals(100, $user->userExperience());
    }


}
