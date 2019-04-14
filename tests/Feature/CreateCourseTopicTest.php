<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateCourseTopicTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function administrator_may_create_a_new_topic()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());

        $topic = make('App\Topic');
        $section = create('App\Section');
        $course = create('App\Course');

        $response = $this->post(route('topic.store', ['course' => $course->id, 'section' => $section->id]), $topic->toArray());
        $this->assertDatabaseHas('topics', ['title' => $topic->title]);

    }

    /** @test */
    public function non_administrator_may_not_create_new_topic()
    {
        $this->withExceptionHandling();
        $this->signIn();

        $section = create('App\Section');

        $course = create('App\Course');

        $response = $this->post(route('topic.store', ['course' => $course->id, 'section' => $section->id]), [])
            ->assertStatus(403);
    }

    /** @test */
    public function a_topic_requires_a_valid_title()
    {
        $this->publishTopic(['title' => null])
            ->assertSessionHasErrors('title');

        $this->publishTopic(['title' => 'ggggggggggggggggg'])
            ->assertSessionHasErrors('title');
    }


    public function publishTopic($overrides = [])
    {
        $this->withExceptionHandling();
        $this->signIn(factory('App\User')->states('administrator')->create());

        $topic = make('App\Topic', $overrides);

        $section = create('App\Section');
        $course = create('App\Course');

        return $this->post(route('topic.store', ['course' => $course->id, 'section' => $section->id]), $topic->toArray());
    }
}
