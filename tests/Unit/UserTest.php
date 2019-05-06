<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function a_user_can_fetch_their_most_recent_reply()
    {
        $user = create('App\User');
        $reply = create('App\Reply', ['user_id' => $user->id]);

        $this->assertEquals($reply->id, $user->lastReply->id);
    }

    /** @test */
    public function a_user_can_determine_their_avatar_path()
    {
        $user = create('App\User');
        $this->assertEquals(asset('storage/avatars/default.png'), $user->avatar_path);

        $user->avatar_path = 'avatars/me.jpg';

        $this->assertEquals(asset('storage/avatars/me.jpg'), $user->avatar_path);
    }

    /** @test */
    public function an_admin_can_update_any_user()
    {
        $this->signIn(factory('App\User')->state('administrator')->create());

        $user = create('App\User');
        $data = $user->toArray();

        $data['f_name'] = 'Martins';
        $data['l_name'] = 'Ushie';

        $user->update($data);

        $this->assertEquals($data['f_name'], $user->f_name);
    }
}
