<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AchievementTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_be_assigned_any_achievement()
    {
    	$user = create('App\User');
    	$achievement = create('App\Achievement');

    	$achievement->awardTo($user);

    	$this->assertCount(1, $user->achievements);
    	$this->assertTrue($user->achievements[0]->is($achievement));
    }

    /** @test */
    public function an_achievement_badge_is_unlocked_once_a_users_experience_points_pass_1000()
    {
        $user = create('App\User');

        $user->awardExperience(1001, 'Best Comment');

        $this->assertCount(1, $user->achievements);
        
    }
}
