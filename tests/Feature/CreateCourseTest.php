<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateCourseTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function a_non_administrator_cannot_create_a_new_course()
    {
        $this->withExceptionHandling();
        $this->signIn(create('App\User'));
        
        $response = $this->post(route('courses.store'), [])
            ->assertStatus(403);
    }

    /** @test */
    public function an_administrator_may_create_new_course()
    {
        $course = $this->publishCourse();
        $this->assertDatabaseHas('courses', ['title' => $course->title]);
    }

    /** @test */
    public function a_newly_created_course_is_unpublished()
    {
        $course = $this->publishCourse();
        $this->assertDatabaseHas('courses', ['title' => $course->title, 'published' => false]);
    }

    /** @test */
    public function an_administrator_may_publish_a_course()
    {
        // $this->withExceptionHandling();
        $this->signIn(factory('App\User')->states('administrator')->create());
        $course = create('App\Course');
        
        $this->get(route('courses.publish', ['course' => $course->slug]));
        $this->assertTrue($course->fresh()->published);
        
    }

    /** @test */
    public function an_administrator_may_unPublish_a_course()
    {
        // $this->withExceptionHandling();
        $this->signIn(factory('App\User')->states('administrator')->create());
        $course = create('App\Course');
        $course->publish();
        $this->assertTrue($course->fresh()->published);
        
        $this->get(route('courses.unPublish', ['course' => $course->slug]));
        $this->assertFalse($course->fresh()->published);

        
    }

    public function publishCourse($overrides = [])
    {
        $this->signIn(factory('App\User')->states('administrator')->create());
        create('App\Type');
        $course = make('App\Course', $overrides);
        $response = $this->post(route('courses.store'), $course->toArray());


        return $course;
    }
}
