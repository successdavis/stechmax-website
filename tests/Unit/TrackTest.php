<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TrackTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function a_track_can_be_assigned_a_course()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());
        create('App\Type', []);
        $courseOne = create('App\Course');
        $courseTwo = create('App\Course');
        $courseThree = create('App\Course');

        $track = factory('App\Course')->states('track')->create();

        $track->attachCourseToTrack($courseTwo);
        $this->assertCount(1, $track->childrenCourses()->get());
        $this->assertDatabaseHas('course_tracks', ['course_id' => $courseTwo->id, 'track_id' => $track->id]);
    }

    /** @test */
    public function an_order_id_is_automaticaly_set_when_attaching_a_new_course_to_a_track()
    {
    $this->signIn(factory('App\User')->states('administrator')->create());
        $course = create('App\Course');
        $courseTwo = create('App\Course');
        $track = factory('App\Course')->states('track')->create();

        $track->attachCourseToTrack($course);
        $this->assertDatabaseHas('course_tracks', ['order' => 1]);

        $track->attachCourseToTrack($courseTwo);
        $this->assertDatabaseHas('course_tracks', ['order' => 2]);
    }

    /** @test */
    public function the_same_course_cannot_be_assign_to_a_course_twice()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());

        $course = create('App\Course');
        $track = factory('App\Course')->states('track')->create();

        $this->post(route('track.store', ['course' => $track]), $course->toArray());
        $this->assertDatabaseHas('course_tracks', ['order' => 1]);

        $respond = $this->post(route('track.store', ['course' => $track]), $course->toArray());
        $respond->assertStatus(422);
        $this->assertDatabaseMissing('course_tracks', ['order' => 2]);

    }

    /** @test */
    public function an_admin_can_retrive_all_courses_related_to_a_track()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());
        create('App\Type', []);
        $courseOne = create('App\Course');
        $courseTwo = create('App\Course');
        $courseThree = create('App\Course');

        $track = factory('App\Course')->states('track')->create();

        $track->attachCourseToTrack($courseTwo);
        $track->attachCourseToTrack($courseOne);
        $courses = $this->getJson('api/courses/'. $track->slug .'/getcourses')->json();
        $this->assertCount(2, $courses);
    }

// this test needs to be refactored. it doesnot explain its name
    /** @test */
    public function the_order_pattern_can_be_reodered()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());
        create('App\Type', []);
        $courseOne = create('App\Course');
        $courseTwo = create('App\Course');
        $courseThree = create('App\Course');

        $track = factory('App\Course')->states('track')->create();

        $track->attachCourseToTrack($courseOne);
        $track->attachCourseToTrack($courseTwo);
        $track->attachCourseToTrack($courseThree);

        $response = $this->getJson(route('courses.getCourses', ['course' => $track->slug]))->json();
        // dd($response);
        $this->assertEquals([1, 2, 3], array_column($response, 'id'));

        $courses = $this->getJson('api/courses/'. $track->slug .'/getcourses')->json();
        $this->assertCount(3, $courses);
    }

    /** @test */
    public function an_admin_can_remove_a_course_from_a_track()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());
        $course = create('App\Course');
        $track = factory('App\Course')->states('track')->create();
        
        $track->attachCourseToTrack($course);;
        $courses = $this->getJson('api/courses/'. $track->slug .'/getcourses')->json();
        $this->assertCount(1, $courses);   

        $this->delete(route('track.destroy', ['course' => $track->slug]), $course->toArray());
        $courses = $this->getJson('api/courses/'. $track->slug .'/getcourses')->json();
        $this->assertCount(0, $courses);   

    }
}
