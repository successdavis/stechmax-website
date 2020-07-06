<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;


class AchievementsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->achievement = create('App\Achievement');
    }

        /** @test */
    public function an_acheivement_database_has_the_following_fields()
    {
        $this->assertTrue(Schema::hasColumns('achievements', [
            'id', "name","description","icon"
          ]), 1);
    }
}
