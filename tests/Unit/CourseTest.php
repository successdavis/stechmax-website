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
    
    public function setUp(): void
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
        $this->assertEquals("/courses/{$course->subject->slug}/{$course->slug}", $course->path());
    }

    /** @test */
    public function it_should_consist_with_what_the_user_will_learn()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());
        $course = create('App\Course');
        $learn = make('App\Learn', ['course_id' => $course->id]);
        $response = $this->post(route('learn.store', ['course' => $course->slug]), $learn->toArray());
        
        $this->assertCount(1, $course->learns);
        // $this->assertInstanceOf('App\Course', $learn->course);
    }

    /** @test */
    public function it_should_consist_requirements_the_user_must_know()
    {   
        $this->signIn(factory('App\User')->states('administrator')->create());

        $requirement = make('App\Requirement', ['course_id' => $this->course->id]);
        $this->post(route('requirement.store', ['course' => $this->course->slug]), $requirement->toArray());
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

    /** @test */
    public function a_user_can_get_a_properly_formatted_course_amount()
    {
        $course = create('App\Course');
        $this->assertEquals("1,450.00", $course->getAmount());
    }

    /** @test */
    public function a_classroom_fee_is_added_to_course_amount_when_classroom_fee_is_requested()
    {
        $siteconfig = create('App\siteconfig');
        $this->assertEquals("2,450.00", $this->course->getAmountWithClassroom());
    }

    /** @test */
    public function a_course_may_support_part_payment()
    {
        $this->assertFalse($this->course->supportPartPayment());

        $this->course->enablePartPayment();
        $this->assertTrue($this->course->supportPartPayment());
    }
}
