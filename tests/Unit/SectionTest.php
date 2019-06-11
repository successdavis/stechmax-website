<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SectionTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function it_consist_of_course_topics()
    {
        $section = create('App\Section');
        $lecture = create('App\Lecture', ['section_id' => $section->id]);

         $this->assertTrue($section->lectures->contains($lecture));
    }
}
