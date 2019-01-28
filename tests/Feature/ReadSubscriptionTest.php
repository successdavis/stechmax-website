<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadSubscriptionTest extends TestCase
{
    use DatabaseMigrations;
    
    public function setUp()
    {
        parent::setUp();

        $this->user = create('App\User');
    }

    /** @test */
    public function a_user_can_browse_for_courses_enrolled_to()
    {
        $this->signIn();
        $subscribedCourse = create('App\Course');
        $notSubscribedCourse = create('App\Course');

        $this->user->subscribeToCourse($subscribedCourse);

        $this->get("/profiles/{$this->user->name}/courses")
            ->assertSee($subscribedCourse->title)
            ->assertDontSee($notSubscribedCourse->title);
    }
}
