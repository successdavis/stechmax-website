<?php

namespace Tests\Feature;

use App\Achievements\AchievementType;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class AchievementTypeTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_sets_a_default_name()
    {
		$type = new FakeAchievementType();

		$this->assertEquals('Fake Achievement Type', $type->name());
    }
}

class FakeAchievementType extends AchievementType
{
	public $description = 'Some Dummy Description';
	public $icon 		= 'icon.svg';

	public function qualifier($user)
	{
		
	}
}
