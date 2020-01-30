<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;


class LectureVideoTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp():void
    {
        parent::setUp();

        $this->lecture = create('App\Lecture');        
    }

    /** @test */
    public function a_video_can_be_uploaded_for_a_lecture()
    {
    	$this->signIn(factory('App\User')->states('administrator')->create());

        $this->publishVideo();

    	$this->assertEquals(asset('storage/lecturevideo/'.$this->lecture->slug), $this->lecture->fresh()->getVideoUrl());

    	Storage::disk('public')->assertExists('lecturevideo/' . $this->lecture->slug);
    }

    /** @test */
    public function a_video_can_be_removed_from_a_lecture()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());

        $this->publishVideo();

        $this->json('DELETE', 'api/' . $this->lecture->slug . '/deletevideo');

        $this->assertNull($this->lecture->video);
    }

    /** @test */
    public function a_video_can_be_updated_for_a_lecture()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());

        $this->publishVideo();

        $this->json('PATCH', 'api/' . $this->lecture->slug . '/updatevideo', ['video' => $file = UploadedFile::fake()->create('lecture-video.mp4', 90)]);

        $this->assertEquals(asset('storage/lecturevideo/'.$this->lecture->slug), $this->lecture->fresh()->getVideoUrl());

        Storage::disk('public')->assertExists('lecturevideo/' . $this->lecture->slug);
    }

    public function publishVideo()
    {
        Storage::fake('public');

        $this->json('POST', 'api/' . $this->lecture->slug . '/video', ['video' => $file = UploadedFile::fake()->create('lecture-video.mp4', 90)]);
    }
}
