<?php

namespace Tests\Feature;

use App\Mail\UnableToSetSystemNumber;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

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
        $user = $this->signIn();
        $course  = create('App\Course');
        $course->createSubscription();
        $this->assertCount(1, auth()->user()->subscriptions);
    }


    /** @test */
    public function a_user_can_have_only_one_active_subscription_for_a_product()
    {
        $user = $this->signIn();
        $course  = create('App\Course');
        $course->createSubscription();
        $this->assertCount(1, auth()->user()->subscriptions);

        try{

            $course->createSubscription();
        }catch (\Exception $e){
            $this->fail('Your subscription to this course is still active');
        }
        $this->assertCount(1, auth()->user()->fresh()->subscriptions);
    }

    /** @test */
    public function a_user_can_resubscribe_to_course_only_previous_subscription_has_elapsed()
    {
        $user = $this->signIn();
        $course  = create('App\Course');
        $course->createSubscription();
        $this->assertCount(1, auth()->user()->subscriptions);

        $course->deactivateSubscription();

        try{
            $course->createSubscription();
        }catch (\Exception $e){
            $this->fail('Your subscription to this course is still active');
        }
        $this->assertCount(2, auth()->user()->fresh()->subscriptions);
    }

    /** @test */
    public function a_subscription_can_be_deactivated()
    {
        $user = $this->signIn();

        $course  = create('App\Course');
        $course->createSubscription();
        $this->assertCount(1, auth()->user()->subscriptions);

        $course->deactivateSubscription();

        $this->assertFalse($course->isSubscribedBy(auth()->user()));
    }

    /** @test */
    public function it_is_assign_system_no_number_if_class_training_is_true()
    {
        $user = $this->signIn();

        $course  = create('App\Course');
        $subscription = $course->createSubscription('', '', $class = true);

        $this->assertEquals('11/1', $subscription->system_no);      
    }

    /** @test */
    public function an_email_is_sent_if_unable_to_assign_systemNo()
    {
        Mail::fake();

        factory('App\Subscription', 15)->create();


        $user = $this->signIn();

        $admin = factory('App\User')->states('administrator')->create();
        $admin2 = factory('App\User')->states('administrator')->create();

        $course  = create('App\Course');
        $subscription = $course->createSubscription('', '', $class = true);      

        Mail::assertQueued(UnableToSetSystemNumber::class); 
    }
}
