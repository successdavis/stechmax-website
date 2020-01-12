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

        $this->type = create('App\Type', ['name' => 'course']);

        $this->course = create('App\Course', ['published' => true, 'type_id' => $this->type->id]);
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
    public function a_user_can_browse_courses_by_subjects()
    {
        $subject = create('App\Subject');
        $courseInSubject = create('App\Course', ['subject_id' => $subject->id, 'published' => true, 'type_id' => $this->type->id]);
        $courseNotInSubject = create('App\Course', ['subject_id' => $subject->id, 'published' => true, 'type_id' => $this->type->id]);

        $this->get('/courses/' . $subject->slug)
            ->assertSee($courseInSubject->title);
            // ->assertDontSee($courseNotInSubject->title);
    }

    /** @test */
    public function an_admin_can_retrive_all_courses()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());

        $course = create('App\Course',['type_id' => 1]);
        $track = factory('App\Course')->states('track')->create();

        $courses = $this->getJson('api/courses/allcourses')->json();
        $this->assertCount(2, $courses);
    }
}
