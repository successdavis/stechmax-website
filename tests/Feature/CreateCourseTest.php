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
    public function administrator_may_create_a_new_course()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());
        
        $course = make('App\Course');

        $response = $this->post(route('courses.store'), $course->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee($course->title)
            ->assertSee($course->description);
    }

    /** @test */
    public function non_administrator_may_not_create_new_course()
    {
        $this->withExceptionHandling();
        $this->signIn();

        $course = make('App\Course');

        $response = $this->post(route('courses.store'), $course->toArray())
            ->assertStatus(403);
    }

    /** @test */
    public function a_course_requires_a_valid_subject()
    {
        $this->withExceptionHandling();
        $this->signIn(factory('App\User')->states('administrator')->create());
        
        $this->publishCourse(['subject_id' => null])
            ->assertSessionHasErrors('subject_id');

        $this->publishCourse(['subject_id' => 999])
            ->assertSessionHasErrors('subject_id');
    }

    /** @test */
    public function a_course_requires_a_valid_type_id()
    {
        $this->withExceptionHandling();

        $this->signIn(factory('App\User')->states('administrator')->create());
        
        $this->publishCourse(['type_id' => null])
            ->assertSessionHasErrors('type_id');

        $this->publishCourse(['type_id' => 889])
            ->assertSessionHasErrors('type_id');
    }

    public function publishCourse($overrides = [])
    {
        $this->withExceptionHandling();
        $this->signIn(factory('App\User')->states('administrator')->create());

        $course = make('App\Course', $overrides);

        return $this->post(route('courses.store'), $course->toArray());
    }
}
