<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;


class AddCoursePromoVideoTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_promo_video_can_be_uploaded_for_a_course()
    {
    	$this->signIn(factory('App\User')->states('administrator')->create());

    	Storage::fake('public');
    	$course = create('App\Course');

    	$this->json('POST', 'api/course/' . $course->slug . '/promovideo', ['video' => $file = UploadedFile::fake()->create('promo-video.mp4', 90)]);

    	$this->assertEquals(asset('storage/promovideo/'.$course->title), $course->fresh()->video_path);

    	Storage::disk('public')->assertExists('promovideo/' . $course->title);
    }


    /** @test */
    public function only_an_admin_can_upload_course_promo_video()
    {
    	$this->signIn();
    	Storage::fake('public');

    	$this->withExceptionHandling();
    	$course = create('App\Course');

    	$this->json('POST', 'api/course/' . $course->title . '/promovideo', ['video' => $file = UploadedFile::fake()->create('promo-video.mp4', 90)])
    		->assertStatus(403);
    }

    /** @test */
    public function a_valid_video_must_be_provided()
    {
    	$this->withExceptionHandling();
    	
    	$this->signIn(factory('App\User')->states('administrator')->create());
    	$course = create('App\Course');

    	$this->json('POST', 'api/course/' . $course->title . '/promovideo', ['video' => 'somevideo'])
    		->assertStatus(422);
    	
    }
}
