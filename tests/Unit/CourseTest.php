<?php

namespace Tests\Unit;

use Carbon\Carbon;
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

    /** @test */
    public function it_can_be_browse_by_subjects()
    {
        $subject = create('App\Subject');
        $courseInSubject = create('App\Course', ['subject_id' => $subject->id]);
        $courseNotInSubject = create('App\Course');

        $this->get('/courses/' . $subject->slug)
            ->assertSee($courseInSubject->title)
            ->assertDontSee($courseNotInSubject->title);
    }

    /** @test */
    public function it_can_be_browse_by_price_lowest_to_highess()
    {
        $firstCourse = create('App\Course', ['fee' => '3000', 'created_at' => Carbon::now()->subWeek()]);
        $secondCourse = create('App\Course', ['fee' => '145000']); 

        $response = $this->getJson('/courses?fee=asc')->json();
        $this->assertEquals([3000, 145000], array_column($response, 'fee'));
    }

    /** @test */
    public function it_can_be_browse_by_price_highest_to_lowest()
    {
        $firstCourse = create('App\Course', ['fee' => '3000', 'created_at' => Carbon::now()->subWeek()]);
        $secondCourse = create('App\Course', ['fee' => '145000']); 

        $response = $this->getJson('/courses?fee=desc')->json();
        $this->assertEquals([145000, 3000], array_column($response, 'fee'));
    }

    /** @test */
    public function it_can_be_browse_alphabetically()
    {
        $firstCourse = create('App\Course', ['title' => 'a', 'created_at' => Carbon::now()->subWeek()]);
        $secondCourse = create('App\Course', ['title' => 'b']); 

        $response = $this->getJson('/courses?alphabet=asc')->json();
        $this->assertEquals(['a', 'b'], array_column($response, 'title'));
    }

    /** @test */
    public function it_can_be_browse_difficulty()
    {
        $firstCourse = create('App\Course', ['difficulty' => 'intermediate']);
        $secondCourse = create('App\Course', ['difficulty' => 'beginner']); 
        $thirdCourse = create('App\Course', ['difficulty' => 'advance']); 

        $response = $this->get('/courses?difficulty=beginner')
            ->assertSee($secondCourse->title)
            ->assertDontSee($firstCourse->title)
            ->assertDontSee($thirdCourse->title);

        $response = $this->get('/courses?difficulty=intermediate')
            ->assertDontSee($secondCourse->title)
            ->assertSee($firstCourse->title)
            ->assertDontSee($thirdCourse->title);
    }

    /** @test */
    public function it_should_consist_with_what_the_user_will_learn()
    {
        $course = create('App\Course');
        $learn = create('App\Learn', ['course_id' => $course->id]);
        
        $this->assertInstanceOf('App\Course', $learn->course);
    }

    /** @test */
    public function it_should_consist_requirements_the_user_must_know()
    {
        $course = create('App\Course');
        $requirement = create('App\Requirement', ['course_id' => $course->id]);

        $this->assertInstanceOf('App\Course', $requirement->course);
    }

    /** @test */
    public function it_should_consist_of_lesson_sections()
    {
        $course = create('App\Course');
        $section = create('App\Section', ['course_id' => $course->id]);

        $this->assertInstanceOf('App\Course', $section->course);
    }
}
