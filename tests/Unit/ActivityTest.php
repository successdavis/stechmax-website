<?php

namespace Tests\Feature;

use App\Activity;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ActivityTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_records_activity_when_a_thread_is_created()
    {
        $this->signIn();

        $thread = create('App\Thread');

        $this->assertDatabaseHas('activities', [
            'type' => 'created_thread',
            'user_id' => auth()->id(),
            'subject_id' => $thread->id,
            'subject_type' => 'App\Thread'
        ]);

        $activity = Activity::first();

        $this->assertEquals($activity->subject->id, $thread->id);
    }

    /** @test */
    public function it_records_activity_when_a_reply_is_created()
    {
        $this->signIn();

        $reply = create('App\Reply');
        $this->assertEquals(2, Activity::count());
    }

    /** @test */
    public function it_fetches_a_feed_for_any_user()
    {
        $this->signIn();
        create('App\Thread', ['user_id' => auth()->id()], 2);
        auth()->user()->activity()->first()->update(['created_at' => Carbon::now()->subWeek()]);

        $feed = Activity::feed(auth()->user());
        $this->assertTrue($feed->keys()->contains(
            Carbon::now()->format('Y-m-d')
        ));

        $this->assertTrue($feed->keys()->contains(
            Carbon::now()->subWeek()->format('Y-m-d')
        ));
    }

    /** @test */
    public function it_has_priority_of_low_medium_and_high()
    {
        $this->signIn();
        create('App\Thread', ['user_id' => auth()->id()], 1);

        $feed = Activity::first();
        $this->assertNotNull($feed->priority);
    }

    /** @test */
    public function it_records_activity_when_a_payment_has_been_added_with_priority_set_to_high()
    {
        $this->signIn();
        $invoice = create('App\Invoice');
        $payments = create('App\Payments', ['invoice_id' => $invoice->id], 2);

        $feed = Activity::first();
        $this->assertEquals(2, Activity::count());
        $this->assertEquals($feed->priority, 1);
    }

    /** @test */
    public function it_records_activity_when_an_invoice_has_been_created_with_priority_set_to_high()
    {
        $this->signIn();
        $invoice = create('App\Invoice');

        $feed = Activity::first();
        $this->assertEquals(1, Activity::count());
        $this->assertEquals($feed->priority, 1);
    }

    /** @test */
    public function it_records_activity_when_points_are_awarded()
    {
        $this->signIn();
        $invoice = create('App\Invoice');

        $feed = Activity::first();
        $this->assertEquals(1, Activity::count());
        $this->assertEquals($feed->priority, 1);
    }


    /** @test */
    public function it_fetches_a_feed_that_has_priority_of_1_for_an_administrator()
    {
        $this->signIn();
        $invoice = create('App\Invoice');
        $payments = create('App\Payments', ['invoice_id' => $invoice->id], 2);

        $feed = Activity::adminFeed();
        $this->assertTrue($feed->keys()->contains(
            Carbon::now()->format('Y-m-d')
        ));
    }
}
