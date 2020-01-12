<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AddCourseImageTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_unauthenticated_user_cannot_add_course_image()
    {
        $this->withExceptionHandling();

        $this->json('POST', 'api/courses/em/1')
            ->assertStatus(401);
    }

    /** @test */
    public function a_none_administrator_cannot_add_course_image()
    {
        $this->withExceptionHandling();

        $this->signIn();
        $course = create('App\Course');

        $this->json('POST', 'api/courses/'. $course->subject->slug .'/' . $course->slug)
            ->assertStatus(403);
    }


    /** @test */
    public function a_valid_thumbnail_must_be_provided()
    {
        $this->withExceptionHandling()->signIn(factory('App\User')->states('administrator')->create());
        $course = create('App\Course');

        $this->json('POST', 'api/courses/' . $course->subject->slug . '/' . $course->slug, ['thumbnail' => 'not an image'])
            ->assertStatus(422);
    }


     /** @test */
    public function an_administrator_may_add_course_image()
    {
        $this->withExceptionHandling();
        $this->signIn(factory('App\User')->states('administrator')->create());

        $course = create('App\Course');

        storage::fake('public');

        $this->json('POST', 'api/courses/' . $course->subject->slug . '/' . $course->slug, ['thumbnail' => $file = UploadedFile::fake()->image('thumbnail.jpg', '750', '422')]);

        $this->assertEquals(asset('storage/thumbnails/'.$file->hashName()), $course->fresh()->thumbnail_path);

        Storage::disk('public')->assertExists('thumbnails/' . $file->hashName());
    }
}
