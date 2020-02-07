<?php

namespace Tests\Feature;
 
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class CourseStudyRoomTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->course = create('App\Course');
        $this->user = create('App\User');
        $this->invoice = create('App\Invoice');
    }

    /** @test */
    public function a_subscribed_user_can_visit_a_course_study_room()
    {
        $this->signIn($this->user);
        
    	$this->course->createSubscription($this->user->id, $this->invoice->id);

    	$this->get('/studyroom/' . $this->course->slug)
    		->assertStatus(200);
    }

    /** @test */
    public function an_unsubscribed_user_canno_visit_a_course_study_room()
    {
        $this->signIn($this->user);

        $this->get('/studyroom/' . $this->course->slug)
            ->assertRedirect(route('studyroom.index', ['course'=> $this->course->slug]))
            ->assertSessionHas('flash', 'You have no active subscription to this course');
    }
}
