<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ReadTestimonialsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->testimonial = create('App\Testimonial');
    }

    /** @test */
    public function all_testimonials_can_be_retrieved()
    {
        $testimonials = create('App\Testimonial',[],30);
        $response = $this->get('/testimonials')
            ->assertSee($this->testimonial->testimonial);
    }

    /** @test */
    public function only_approved_testimonials_can_be_retrieved()
    {
        $this->testimonial->approve();
        $testimonialTwo = create('App\Testimonial');

        $response = $this->json('GET', '/testimonials?approve=true')->json();

        $this->assertCount(1, $response['data']);
    }

    /** @test */
    public function testimonials_can_be_retrieved_for_any_course()
    {
        $course = create('App\Course');
        $testimonialTwo = create('App\Testimonial', ['course_id' => $course->id]);

        $response = $this->json('GET', '/testimonials/' . $course->slug)->json();

        $this->assertCount(1, $response['data']);
    }
}
