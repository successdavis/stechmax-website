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
    public function an_admin_can_retrieve_all_testimonials()
    {
        $response = $this->get('/testimonials');

        dd($response);
    }
}
