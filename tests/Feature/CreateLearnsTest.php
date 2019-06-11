<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateLearnsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function administrator_may_create_a_new_learn()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());

        $learn = make('App\Learn');
        $course = create('App\Course');

        $response = $this->post(route('learn.store', ['course' => $course->id]), $learn->toArray());

        $this->get($course->path())
            ->assertStatus(200);
    }

    /** @test */
    public function non_administrator_may_not_create_new_learn()
    {
        $this->withExceptionHandling();
        $this->signIn();

        $course = create('App\Course');

        $response = $this->post(route('learn.store', ['course' => $course->id]), [])
            ->assertStatus(403);
    }

    /** @test */
    public function a_learn_requires_a_valid_body()
    {
        $this->publishLearn(['body' => null])
            ->assertSessionHasErrors('body');

        $this->publishLearn(['body' => 'eeeeeee'])
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function a_learn_auto_set_a_unique_order_number()
    {
        $course = create('App\Course');
        $learn = $this->publishLearn(['course_id' => $course->id])->json();
        $this->assertEquals(1, $learn['order']);

        $learnTwo = $this->publishLearn(['course_id' => $course->id])->json();
        $this->assertEquals(2, $learnTwo['order']);
    }


    public function publishLearn($overrides = [])
    {
        $this->withExceptionHandling();
        $this->signIn(factory('App\User')->states('administrator')->create());
        $learn = make('App\Learn', $overrides);
        return $this->post(route('learn.store', ['course' => $learn->course_id]), $learn->toArray());
    }


}
