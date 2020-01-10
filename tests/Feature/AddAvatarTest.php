<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AddAvatarTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function an_unathenticated_users_cannot_upload_avatars()
    {
        $this->withExceptionHandling();

        $this->json('POST', 'api/users/1/avatar')
            ->assertStatus(401);
    }

    /** @test */
    public function a_valid_avatar_must_be_provided()
    {
        $this->withExceptionHandling()->signIn();

        $this->json('POST', 'api/users/' . auth()->user()->username . '/avatar', ['avatar' => 'not-an-image'])
            ->assertStatus(422);

        return redirect($school->path())
            ->with('flash', 'School Created');
    }

    /** @test */
    public function an_authenticated_user_may_add_an_avatar_to_their_profile()
    {
        $this->signIn();

        Storage::fake('public');

        $this->json('POST', 'api/users/' . auth()->user()->username . '/avatar', ['avatar' => $file = UploadedFile::fake()->image('avatar.jpg')]);

        $this->assertEquals(asset('storage/avatars/'.$file->hashName()), auth()->user()->avatar_path);

        Storage::disk('public')->assertExists('avatars/' . $file->hashName());
    }

    /** @test */
    public function an_administrator_may_upload_an_avatar_for_any_user()
    {
        $this->signIn(factory('App\User')->state('administrator')->create());

        $user = create('App\User');

        Storage::fake('public');

        $this->json('POST', 'api/users/' . $user->username . '/avatar', ['avatar' => $file = UploadedFile::fake()->image('avatar.jpg')]);

        $this->assertEquals(asset('storage/avatars/'.$file->hashName()), $user->fresh()->avatar_path);

        Storage::disk('public')->assertExists('avatars/' . $file->hashName());
    }
}
