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
    
    public function setUp()
    {
        parent::setUp();

        $this->course = create('App\Course', ['published' => true]);
    }

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
        $courseInSubject = create('App\Course', ['subject_id' => $subject->id, 'published' => true]);
        $courseNotInSubject = create('App\Course');

        $this->get('/courses/' . $subject->slug)
            ->assertSee($courseInSubject->title);
            // ->assertDontSee($courseNotInSubject->title);
    }


    /** @test */
    public function it_can_be_browse_by_price_lowest_to_highess()
    {
        $firstCourse = create('App\Course', ['amount' => '3000', 'created_at' => Carbon::now()->subWeek(), 'published' => true]);
        $secondCourse = $this->course; 
        $response = $this->getJson('/courses?amount=asc')->json();
        $this->assertEquals([3000, 145000], array_column($response, 'amount'));
    }

    /** @test */
    public function it_can_be_browse_by_price_highest_to_lowest()
    {
        $firstCourse = create('App\Course', ['amount' => '3000', 'created_at' => Carbon::now()->subWeek(), 'published' => true]);
        $secondCourse = $this->course; 

        $response = $this->getJson('/courses?amount=desc')->json();
        $this->assertEquals([145000, 3000], array_column($response, 'amount'));
    }

    /** @test */
    public function it_can_be_browse_by_difficulty()
    {
        $beginner = create('App\Difficulty', ['level' => 'beginner',]);
        $intermediate = create('App\Difficulty', ['level' => 'intermediate',]);
        $advance = create('App\Difficulty', ['level' => 'advance',]);

        $firstCourse = create('App\Course', ['difficulty_id' => $intermediate->id, 'published' => true]);
        $secondCourse = create('App\Course', ['difficulty_id' => $beginner->id, 'published' => true]);
        $thirdCourse = create('App\Course', ['difficulty_id' => $advance->id, 'published' => true]);


        $this->get('/courses?difficulty=beginner')
            ->assertSee($secondCourse->title);
            // ->assertDontSee($firstCourse->title)
            // ->assertDontSee($thirdCourse->title);
    }

    /** @test */
    public function it_should_consist_with_what_the_user_will_learn()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());
        $course = create('App\Course');
        $learn = make('App\Learn', ['course_id' => $course->id]);
        $response = $this->post(route('learn.store', ['course' => $course->id]), $learn->toArray());
        
        $this->assertCount(1, $course->learns);
        // $this->assertInstanceOf('App\Course', $learn->course);
    }

    /** @test */
    public function it_should_consist_requirements_the_user_must_know()
    {   
        $this->signIn(factory('App\User')->states('administrator')->create());

        $requirement = make('App\Requirement', ['course_id' => $this->course->id]);
        $this->post(route('requirement.store', ['course' => $this->course->id]), $requirement->toArray());
        $this->assertCount(1, $this->course->requirements);
        
    }

    /** @test */
    public function it_should_consist_of_lesson_sections()
    {
        $section = create('App\Section', ['course_id' => $this->course->id]);

        $this->assertInstanceOf('App\Course', $section->course);
    }

    /** @test */
    public function it_can_be_published()
    {
        $course = create('App\Course');
        $this->assertFalse($course->published);

        $course->publish();

        $this->assertTrue($course->published);
    }

    /** @test */
    public function it_can_be_unPublished()
    {
        $course = create('App\Course');
        $course->publish();
        $this->assertTrue($course->published);

        $course->unPublish();

        $this->assertFalse($course->published);
    }
}
