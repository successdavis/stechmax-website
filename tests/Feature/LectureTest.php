<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


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
    public function subscribe_user_may_access_billed_lecture_video_url()
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

    /** @test */
    // public function an_admin_can_attach_a_video_to_a_course()
    // {
    //     $this->withExceptionHandling();
    //     $this->signIn(factory('App\User')->states('administrator')->create());
    //     $lecture = create('App\Lecture');
    //     $this->json('POST', 'api/' . $lecture->id . '/attachvideo', ['video' => $file = UploadedFile::fake()->create('promo-video.mp4', 90)]);


    //     $this->assertEquals(asset('storage/lecturesvideo/'.$lecture->title), $lecture->fresh()->getVideoUrl());

    //     // Storage::disk('public')->assertExists('lecturesvideo/' . $lecture->title);
    // }
}
