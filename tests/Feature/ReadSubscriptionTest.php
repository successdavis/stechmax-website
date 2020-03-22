<?php

namespace Tests\Feature;

use App\Subscription;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class ReadSubscriptionTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = create('App\User');
        
    }

    /** @test */
    public function an_admin_can_get_count_off_all_user_with_active_subscription()
    {
        $users = create('App\User',[], 16);
        $this->signIn($this->user);
        $course  = create('App\Course');
        $course->createSubscription();
        $this->assertEquals(1, User::totalUsersWithSub());
    }   

    /** @test */
    public function an_admin_can_get_count_of_total_active_subscriptions()
    {
        $users = create('App\User',[], 16);
        $this->signIn($this->user);
        $course  = create('App\Course');
        $courseTwo  = create('App\Course');

        $course->createSubscription();
        $courseTwo->createSubscription();

        $this->assertEquals(2, Subscription::countActiveSub());
    }   
}
