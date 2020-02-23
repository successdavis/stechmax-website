<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;


class BusinessTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->business = create('App\Business');
    }

    /** @test */
    public function an_administrator_may_add_a_thumbnail_to_a_business()
    {
        $this->signIn();

        Storage::fake('public');

        $path = '/business/' . $this->business->slug . '/thumbnail';

        $this->json('POST', $path, ['thumbnail' => $file = UploadedFile::fake()->image('thumbnail.jpg')]);

        $this->assertEquals(asset('storage/business/'.$file->hashName()), $this->business->fresh()->thumbnail_path);

        Storage::disk('public')->assertExists('business/' . $file->hashName());
    }
}
