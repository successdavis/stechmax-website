<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SubjectTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_consist_of_courses()
    {
        $subject = create('App\Subject');
        $course = create('App\Course', ['subject_id' => $subject->id]);

        $this->assertTrue($subject->courses->contains($course));
    }
}
