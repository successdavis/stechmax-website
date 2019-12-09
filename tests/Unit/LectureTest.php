<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LectureTest extends TestCase
{
	use DatabaseMigrations;
    /**
     * @return void
     */
    /** @test */
    public function it_knows_if_it_is_billable()
    {
    	$lecture = create('App\Lecture');

        $this->assertTrue($lecture->isBilled());
    }

    /** @test */
    public function it_can_retrieve_associated_video_url()
    {
        $lecture = create('App\Lecture');
        $video = factory('App\Video')->create([
            'lecture_id' => $lecture->id,
            'url' => 'videos/' . $lecture->title
        ]);

        $videoUrl = $lecture->getVideoUrl();


        $this->assertEquals($video->url, $videoUrl);
    }
}
