<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;


class TestimonialsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = create('App\User');
        $this->testimonial = create('App\Testimonial');
    }

    /** @test */
    public function testimonials_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('testimonials', [
            'id', "testimonial", "user_id", "course_id"
          ]), 1);
    }

    /** @test */
    public function a_testimonial_belongs_to_a_user()
    {
    	$this->assertInstanceOf('App\User', $this->testimonial->user);
    }

    /** @test */
    public function a_testimonial_belongs_to_a_course()
    {
    	$this->assertInstanceOf('App\Course', $this->testimonial->course);
    }

    /** @test */
    public function a_testimonial_can_be_approved()
    {
        $this->testimonial->approve();
        $this->assertTrue($this->testimonial->status());        
    }
}
