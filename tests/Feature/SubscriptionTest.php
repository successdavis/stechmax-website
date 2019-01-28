<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SubscriptionTest extends TestCase
{
    use DatabaseMigrations;
    
    public function setUp()
    {
        parent::setUp();

        $this->user = create('App\User');
    }

    /** @test */
    public function a_user_can_subscribe_to_a_course()
    {
        $course  = create('App\Course', ['duration' => 3]);

        $this->user->subscribeToCourse($course, 1);

        $this->assertCount(1, $this->user->getSubscribedCourses());
    }

    /** @test */
    public function a_subscription_can_be_deactivated()
    {
        $course  = create('App\Course', ['duration' => 3]);

        $this->user->subscribeToCourse($course, 1);

        $this->user->deactivate($course);

        $this->assertEquals([], $this->user->activeCourses->toArray());
    }
}
