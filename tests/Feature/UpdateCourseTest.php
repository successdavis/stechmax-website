<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateCourseTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function an_administrator_may_update_a_course()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());

        $course = create('App\Course');

        $data = $course->toArray();
        $data['title'] = 'Changed';
        $data['description'] = 'Changed description';

        $this->patch('/courses/' . $course->id, $data);

        tap($course->fresh(), function ($course) {
            $this->assertEquals('Changed', $course->title);
            $this->assertEquals('Changed description', $course->description);
        });
    }
}
