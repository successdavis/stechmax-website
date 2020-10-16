<?php

namespace Tests\Unit;

use App\clienttestimonial;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;


class ClientTestimonialTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->client = create('App\Client');
        $this->clienttestimonial = create('App\clienttestimonial',['client_id' => $this->client->id]);
    }

    /** @test */
    public function client_testimonial_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('clienttestimonials', [
            'id', "testimonial", "rate",'client_id'
          ]), 1);
    }

    /** @test */
    public function a_client_testimonial_belongs_to_a_client()
    {
    	$this->assertInstanceOf('App\Client', $this->clienttestimonial->client);
    }

    /** @test */
    public function a_client_can_see_the_form_to_add_testimony_if_visited_with_a_valid_url(){
        $client = create('App\Client');
        $client->generateTestimonialToken();
        $this->get('/clienttestimonial/' . $client->testimonial_token)
            ->assertSee('Customer Survey');
    }

    /** @test */
    public function a_client_cannot_see_the_testimonial_page_if_visited_with_an_invalid_url() {
        $this->client->generateTestimonialToken();

        $this->get('/clienttestimonial/123456789012345')
            ->assertStatus(302);
    }

    /** @test */
    public function a_client_can_post_a_testimonial_using_a_valid_url() {
        $this->client->generateTestimonialToken();

        $testimony = make('App\clienttestimonial');

        $this->post('/clienttestimonial/' . $this->client->testimonial_token, $testimony->toArray());
        $this->assertCount(1, $this->client->testimonials->toArray());
    }

    /** @test */
    public function a_client_cannot_post_a_testimonial_using_an_invalid_url() {
        $client = create('App\Client');
        $client->generateTestimonialToken();

        $this->post('/clienttestimonial/123456789012345', [
            'testimonial' => 'You are doing great on this business',
            'rate' => '3'
        ])
        ->assertStatus(302);
    }
}
