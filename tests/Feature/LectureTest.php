<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class LectureTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function unsubscribe_users_cannot_access_billed_lecture_url()
    {
        $this->withExceptionHandling();
    	$user 		= $this->signIn();
    	$lecture 	= create('App\Lecture');
    	$video		= create('App\Video', ['lecture_id' => $lecture->id]);

        $this->get(route('lecture.show', ['lecture' => $lecture->title]))
        	->assertStatus(403);
    }

    /** @test */
    public function subscribe_user_may_access_billed_lecture_url()
    {
        $this->withExceptionHandling();
        $user       = $this->signIn();
        $lecture    = create('App\Lecture');
        $video      = create('App\Video', ['lecture_id' => $lecture->id]);

        $lecture->section
            ->course
            ->createSubscription();

        $this->get(route('lecture.show', ['lecture' => $lecture->title]))
            ->assertStatus(200);
    }
}
