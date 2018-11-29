<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadCourseTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->course = create('App\Course');
    }
    
    /** @test */
    public function a_user_can_browse_all_courses()
    {
        //Given 
        $this->get('/courses')
            ->assertSee($this->course->title);
    }

    /** @test */
    public function a_user_can_view_a_single_course()
    {
        $this->get($this->course->path())
            ->assertSee($this->course->title);
    }

    /** @test */
    public function a_user_can_view_children_courses_assign_to_track()
    {
        $courseChildren = create('App\Course');
        $relationship = factory('App\Course_Track')->create(['course_id' => $courseChildren->id, 'track_id' => $this->course->id]);

        $response = $this->assertCount(1, $this->course->childrenCourses);
        $this->get($this->course->path())
            ->assertSee($courseChildren->title); 
    }
}
