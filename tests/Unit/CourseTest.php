<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CourseTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function it_belongs_to_a_subject()
    {
        $course = create('App\Course');

        $this->assertInstanceOf('App\Subject', $course->subject);
    }

    /** @test */
    public function it_can_generate_a_string_path()
    {
        $course = create('App\Course');
        $this->assertEquals("/courses/{$course->subject->slug}/{$course->id}", $course->path());
    }
}
