<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateRequirementsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function administrator_may_create_a_new_requirement()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());

        $requirement = make('App\Requirement');
        $course = create('App\Course');

        $response = $this->post(route('requirement.store', ['course' => $course->id]), $requirement->toArray());
        $this->assertDatabaseHas('requirements', ['body' => $requirement->body]);

    }

    /** @test */
    public function non_administrator_may_not_create_new_requirement()
    {
        $this->withExceptionHandling();
        $this->signIn();

        $course = create('App\Course');

        $response = $this->post(route('requirement.store', ['course' => $course->id]), [])
            ->assertStatus(403);
    }

    /** @test */
    public function a_requirement_requires_a_valid_body()
    {
        $this->publishRequirement(['body' => null])
            ->assertSessionHasErrors('body');

        $this->publishRequirement(['body' => 'eeeeeeeeee'])
            ->assertSessionHasErrors('body');
    }


    public function publishRequirement($overrides = [])
    {
        $this->withExceptionHandling();
        $this->signIn(factory('App\User')->states('administrator')->create());

        $requirement = make('App\Requirement', $overrides);
        $course = create('App\Course');

        return $this->post(route('requirement.store', ['course' => $course->id]), $requirement->toArray());
    }
}
