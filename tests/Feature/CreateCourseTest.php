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
}
