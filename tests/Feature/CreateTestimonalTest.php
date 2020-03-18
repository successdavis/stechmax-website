<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class CreateTestimonalTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->testimonial = create('App\Testimonial');
        $this->course = create('App\Course');
    }

    /** @test */
    public function a_user_can_create_a_testimonial()
    {
        $user = factory('App\User')->states('administrator')->create();
        $this->signIn($user);
        $data = make('App\Testimonial',[
            'course_id' => $this->course->id, 
            'user_id'   => $user->id
        ]);
        $this->json('POST', 'testimonial/' . $this->course->slug, $data->toArray())
            ->assertStatus(200);
        $this->assertDatabaseHas('testimonials', ['testimonial' => $data->testimonial]);
    }

    /** @test */
    public function a_testimonial_is_required_to_create_a_testimony()
    {
        $this->withExceptionHandling();
        $user = factory('App\User')->states('administrator')->create();
        $this->signIn($user);
        $data = make('App\Testimonial',[
            'course_id' => $this->course->id,
            'testimonial' => null
        ]);
        return $this->post('testimonial/' . $this->course->slug, $data->toArray())
            ->assertSessionHasErrors('testimonial');
    }
}
