<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateCourseLectureTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function administrator_may_create_a_new_lecture()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());

        $lecture = make('App\Lecture');
        $section = create('App\Section');

        $response = $this->post(route('lecture.store', ['section' => $section->id]), $lecture->toArray());
        $this->assertDatabaseHas('lectures', ['title' => $lecture->title]);

    }

    /** @test */
    public function non_administrator_may_not_create_new_lecture()
    {
        $this->withExceptionHandling();
        $this->signIn();

        $section = create('App\Section');

        $course = create('App\Course');

        $response = $this->post(route('lecture.store', ['section' => $section->id]), [])
            ->assertStatus(403);
    }

    /** @test */
    public function a_lecture_requires_a_valid_title()
    {
        $this->publishLecture(['title' => null])
            ->assertSessionHasErrors('title');

        $this->publishlecture(['title' => 'ggggggggggggggggg'])
            ->assertSessionHasErrors('title');
    }


    public function publishLecture($overrides = [])
    {
        $this->withExceptionHandling();
        $this->signIn(factory('App\User')->states('administrator')->create());

        $lecture = make('App\Lecture', $overrides);

        $section = create('App\Section');
        $course = create('App\Course');

        return $this->post(route('lecture.store', ['course' => $course->id, 'section' => $section->id]), $lecture->toArray());
    }
}
