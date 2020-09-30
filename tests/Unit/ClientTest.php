<?php

namespace Tests\Unit;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ClientTest extends TestCase
{
    use DatabaseMigrations;

        /** @test */
    public function clients_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('clients', [
            'id', "gender", "fullname", "phone","alt_phone","image_path"
          ]), 1);
    }

    /** @test */
    public function a_testimonial_token_can_be_generated_for_a_client() {
        $client = create('App\Client');
        $client->generateTestimonialToken();

        $this->assertNotNull($client->testimonial_token);
    }

    /** @test */
    public function an_admin_can_add_a_client_photo() {
        $this->signIn(factory('App\User')->state('administrator')->create());

        $client = create('App\Client');

        Storage::fake('public');

        $this->json('POST', 'api/client/' . $client->id . '/image', ['avatar' => $file = UploadedFile::fake()->image('avatar.jpg')]);

        $this->assertEquals(asset('storage/clientimages/'.$file->hashName()), $client->fresh()->image_path);

        Storage::disk('public')->assertExists('clientimages/' . $file->hashName());
    }

    /** @test */
    public function an_admin_can_create_a_new_client() {
        $this->signIn(factory('App\User')->state('administrator')->create());
        $client = make('App\Client');

        $this->json('POST', 'api/createclient', $client->toArray())->json();
        $this->assertDatabaseHas('clients',['fullname' => $client->fullname]);
    }

    /** @test */
    public function an_admin_can_delete_a_client() {
        $this->signIn(factory('App\User')->state('administrator')->create());
        $client = create('App\Client');

        $this->json('DELETE', 'api/deleteclient/' . $client->id, $client->toArray())->json();
        $this->assertDatabaseMissing('clients',['fullname' => $client->fullname]);
    }

    /** @test */
    public function an_admin_can_update_a_client() {
        $this->signIn(factory('App\User')->state('administrator')->create());
        $client = create('App\Client');

        $this->json('PATCH', 'api/updateclient/' . $client->id, [
            'fullname'  => 'some new name',
            'gender'    => $client->gender,
            'phone'     => $client->phone,
            'alt_phone' => $client->alt_phone
        ])->json();

        $this->assertEquals($client->fresh()->fullname, 'some new name');
    }
}
