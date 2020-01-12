<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateCourseSectionTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function administrator_may_create_a_new_section()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());

        $section = make('App\Section');
        $course = create('App\Course');

        $response = $this->post(route('section.store', ['course' => $course->slug]), $section->toArray());
        $this->assertDatabaseHas('sections', ['title' => $section->title]);

    }

    /** @test */
    public function non_administrator_may_not_create_new_section()
    {
        $this->withExceptionHandling();
        $this->signIn();

        $course = create('App\Course');

        $response = $this->post(route('section.store', ['course' => $course->slug]), [])
            ->assertStatus(403);
    }

    /** @test */
    public function a_section_requires_a_valid_title()
    {
        $this->publishSection(['title' => null])
            ->assertSessionHasErrors('title');

        $this->publishSection(['title' => 'hhhhhhhh'])
            ->assertSessionHasErrors('title');
    }


    public function publishSection($overrides = [])
    {
        $this->withExceptionHandling();
        $this->signIn(factory('App\User')->states('administrator')->create());

        $section = make('App\Section', $overrides);

        $course = create('App\Course');

        return $this->post(route('section.store', ['course' => $course->slug]), $section->toArray());
    }
}
