<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
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
        $this->assertEquals(asset('storage/avatars/default.jpg'), $user->avatar_path);

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


    /** @test */
        public function a_user_can_update_their_profile()
        {
            // $this->signIn()->withExceptionHandling();

            $dbUser = create('App\User');
            $user = $dbUser->toArray();
            $user['f_name'] = 'changed';
            $user['l_name'] = 'changed';

            $this->patch(route('update.settings.store', ['user' => $user['username']]), $user)
            ->assertStatus(401);

            // tap($dbUser->fresh(), function ($dbUser) {
            //     $this->assertEquals('changed', $dbUser->f_name);
            // });

        }

        /** @test */
            public function a_user_cannot_update_their_password_if_the_old_password_supplied_is_incorrect()
            {
                $dbUser = create('App\User', ['password' => Hash::make('success')]);

                $responds = $this->patch(route('update.setting.password', ['user' => $dbUser['username']]), [
                    'old_password' => 'wrongPassword',
                    'new_password' => 'somedummytext',
                    'confirm_password' => 'somedummytext',
                ])
                ->assertStatus(401);
                tap($dbUser->fresh(), function ($dbUser) {
                    $this->assertFalse($dbUser->validateAndUpdatePassword('somedummytext', $dbUser->password));
                });

            }

        /** @test */
        public function a_user_can_update_their_password_if_the_old_password_supplied_is_correct()
        {
            $dbUser = create('App\User', ['password' => Hash::make('success')]);

            $responds = $this->patch(route('update.setting.password', ['user' => $dbUser['username']]), [
                'old_password' => 'success',
                'new_password' => 'somedummytext',
                'confirm_password' => 'somedummytext',
            ]);
            tap($dbUser->fresh(), function ($dbUser) {
                $this->assertTrue($dbUser->validateAndUpdatePassword('somedummytext', $dbUser->password));
            });

        }

        /** @test */
        public function an_id_is_assigned_to_a_user_when_created()
        {
            $user = create('App\User');

            $userId = 'STM/2019/B11/000' . $user->id;

            // dd('STM/' . date('Y') . '/B' . date('n') . '/' . sprintf('%04d', $user->id));

            $this->assertEquals($userId, $user->user_id);
        }
}
