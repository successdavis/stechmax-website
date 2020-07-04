<?php

namespace Tests\Unit;

use App\Course;
use App\Events\UserEarnedExperience;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class ExperienceTest extends TestCase
{
    use DatabaseMigrations;
    
    public function setUp(): void
    {
        parent::setUp();

        $this->user = create('App\User');
    }

    /** @test */
    public function an_experience_belongs_to_a_user()
    {
        $this->signIn($this->user);
        $exp = $this->user->awardExperience(300, 'Best Answer');

        $this->assertInstanceOf('App\User', $exp);

    }

    /** @test */
    public function experience_can_be_awarded_to_a_user()
    {
        $this->signIn();

        $this->user->awardExperience(500, 'Asked a Question');
        $this->assertEquals(500, $this->user->experienceLevel());
    }

    /** @test */
    public function experience_can_be_strip_off_a_user()
    {
        $this->signIn();

        $this->user->awardExperience(500, 'Best Performing Student');
        $this->user->stripExperience(200);
        $this->assertEquals(300, $this->user->experienceLevel());
    }
}
